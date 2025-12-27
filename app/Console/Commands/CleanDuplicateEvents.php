<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class CleanDuplicateEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:clean-duplicates 
                            {--days=30 : Number of days to check for duplicates}
                            {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean duplicate events based on IP, URL, and time window';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $dryRun = $this->option('dry-run');
        $startDate = Carbon::now()->subDays($days);

        $this->info("Checking for duplicate events from the last {$days} days...");

        // Get all visit events in the date range
        $visitEvents = Event::where('event_name', 'visit')
            ->where('created_at', '>=', $startDate)
            ->orderBy('created_at', 'asc')
            ->get();

        $duplicates = [];
        $keep = [];
        $delete = [];

        foreach ($visitEvents as $event) {
            $key = $event->ip_address . '|' . $event->url;
            $eventTime = Carbon::parse($event->created_at);

            // Check if we already have an event for this IP+URL within 30 seconds
            $found = false;
            foreach ($keep as $keptEvent) {
                $keptKey = $keptEvent->ip_address . '|' . $keptEvent->url;
                $keptTime = Carbon::parse($keptEvent->created_at);

                if ($key === $keptKey && $eventTime->diffInSeconds($keptTime) < 30) {
                    $found = true;
                    $duplicates[] = [
                        'keep' => $keptEvent->id,
                        'delete' => $event->id,
                        'ip' => $event->ip_address,
                        'url' => $event->url,
                        'time_diff' => $eventTime->diffInSeconds($keptTime)
                    ];
                    $delete[] = $event->id;
                    break;
                }
            }

            if (!$found) {
                $keep[] = $event;
            }
        }

        $this->info("Found " . count($duplicates) . " duplicate visit events");

        if (count($duplicates) > 0) {
            $this->table(
                ['Keep ID', 'Delete ID', 'IP Address', 'URL', 'Time Diff (sec)'],
                array_map(function($dup) {
                    return [
                        $dup['keep'],
                        $dup['delete'],
                        $dup['ip'],
                        substr($dup['url'], 0, 50),
                        $dup['time_diff']
                    ];
                }, array_slice($duplicates, 0, 10))
            );

            if (count($duplicates) > 10) {
                $this->info("... and " . (count($duplicates) - 10) . " more duplicates");
            }

            if ($dryRun) {
                $this->warn("DRY RUN: Would delete " . count($delete) . " duplicate events");
                $this->info("Run without --dry-run to actually delete them");
            } else {
                if ($this->confirm('Do you want to delete these duplicate events?', true)) {
                    $deleted = Event::whereIn('id', $delete)->delete();
                    $this->info("Successfully deleted {$deleted} duplicate events");
                } else {
                    $this->info("Operation cancelled");
                }
            }
        } else {
            $this->info("No duplicates found!");
        }

        return 0;
    }
}

