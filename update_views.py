import os

replacements = {
    'tpc': [
        ('Transpark Juanda', 'Transpark Cibubur'),
        ('transpark_juanda', 'transpark_cibubur'),
        ('TPJ', 'TPC'),
        ('tpj', 'tpc'),
        ('JUANDA', 'CIBUBUR'),
        ('Juanda', 'Cibubur')
    ],
    'gkl': [
        ('Transpark Juanda', 'Grand Kamala Lagoon'),
        ('transpark_juanda', 'grand_kamala_lagoon'),
        ('TPJ', 'GKL'),
        ('tpj', 'gkl'),
        ('JUANDA', 'KAMALA'),
        ('Juanda', 'Kamala')
    ],
    'plu': [
        ('Transpark Juanda', 'Patraland Urbano'),
        ('transpark_juanda', 'patraland_urbano'),
        ('TPJ', 'PLU'),
        ('tpj', 'plu'),
        ('JUANDA', 'URBANO'),
        ('Juanda', 'Urbano')
    ],
    'gwc': [
        ('Transpark Juanda', 'Gateway Cicadas'),
        ('transpark_juanda', 'gateway_cicadas'),
        ('TPJ', 'GWC'),
        ('tpj', 'gwc'),
        ('JUANDA', 'CICADAS'),
        ('Juanda', 'Cicadas')
    ],
    'pgv': [
        ('Transpark Juanda', 'Podomoro Golf View'),
        ('transpark_juanda', 'podomoro_golf_view'),
        ('TPJ', 'PGV'),
        ('tpj', 'pgv'),
        ('JUANDA', 'PODOMORO'),
        ('Juanda', 'Podomoro')
    ],
    'bsr': [
        ('Transpark Juanda', 'Bassura City'),
        ('transpark_juanda', 'bassura_city'),
        ('TPJ', 'BSR'),
        ('tpj', 'bsr'),
        ('JUANDA', 'BASSURA'),
        ('Juanda', 'Bassura')
    ],
    'gpc': [
        ('Transpark Juanda', 'Green Pramuka City'),
        ('transpark_juanda', 'green_pramuka_city'),
        ('TPJ', 'GPC'),
        ('tpj', 'gpc'),
        ('JUANDA', 'PRAMUKA'),
        ('Juanda', 'Pramuka')
    ]
}

base_dir = r'resources/views/admin/apartments'

for region, rules in replacements.items():
    region_dir = os.path.join(base_dir, region)
    if not os.path.exists(region_dir):
        print(f"Skipping {region}, directory not found")
        continue

    print(f"Processing {region}...")
    for filename in os.listdir(region_dir):
        if filename.endswith('.blade.php'):
            filepath = os.path.join(region_dir, filename)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # Apply replacements in order
            original_content = content
            for old, new in rules:
                content = content.replace(old, new)
            
            if content != original_content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(content)
                print(f"Updated {filename}")
