@php
use App\Services\AdsTrackingService;
$metaPixelId = AdsTrackingService::getMetaPixelId();
$googleAdsConversionId = AdsTrackingService::getGoogleAdsConversionId();
$metaEnabled = AdsTrackingService::isMetaAdsEnabled();
$googleEnabled = AdsTrackingService::isGoogleAdsEnabled();
$googleConversionLabels = [
    'book_now' => AdsTrackingService::getGoogleAdsConversionLabel('book_now'),
    'download_promo' => AdsTrackingService::getGoogleAdsConversionLabel('download_promo'),
    'form_submit' => AdsTrackingService::getGoogleAdsConversionLabel('form_submit'),
    'visit' => AdsTrackingService::getGoogleAdsConversionLabel('visit'),
];
@endphp

@if($metaEnabled && $metaPixelId)
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{{ $metaPixelId }}');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $metaPixelId }}&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
@endif

@if($googleEnabled && $googleAdsConversionId)
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAdsConversionId }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $googleAdsConversionId }}');
  
  // Store conversion labels untuk digunakan oleh tracking.js
  window.googleAdsConversionLabels = @json($googleConversionLabels);
</script>
<!-- End Google tag -->
@endif

