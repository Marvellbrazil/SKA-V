@props(['image', 'title', 'departement', 'deskripsi' => ''])

@php
    $deptColors = [
        'OTOMOTIF' => 'border-red-500',
        'TIK' => 'border-purple-500',
        'ELEKTRO' => 'border-yellow-500',
        'PEMESINAN' => 'border-blue-500',
    ];
    $colorClass = $deptColors[$departement] ?? 'border-gray-500';
    $deptLower = strtolower($departement);
@endphp

<div class="jur-card w-[380px] shrink-0 rounded-2xl overflow-hidden cursor-pointer group"
     onclick="handleJurusanClick('{{ $title }}', '{{ $departement }}', `{!! nl2br(e($slot)) !!}`, '{{ $image }}', '{{ $deptLower }}')">
    
    <!-- Image Container with Overlay -->
    <div class="relative h-56 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110 group-hover:blur-sm" loading="lazy" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
        
        <!-- Hover Overlay with Selengkapnya -->
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 bg-black/40">
            <span class="text-white font-semibold text-lg flex items-center gap-2">
                <i class="fas fa-info-circle"></i> Selengkapnya
            </span>
        </div>
        
        <!-- Text at Bottom-Left -->
        <div class="absolute bottom-4 left-4 right-4">
            <!-- Vertical Line + Title -->
            <div class="flex items-center gap-3">
                <div class="w-1 h-12 {{ $colorClass }}"></div>
                <div>
                    <h4 class="font-bold text-xl text-white drop-shadow-lg">{{ $title }}</h4>
                    <p class="text-sm text-gray-200">{{ $departement }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function handleJurusanClick(title, dept, desc, image, departemen) {
    // Kirim statistik
    fetch('{{ route("jurusan.increment-stats") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            departemen: departemen,
            type: 'click'
        })
    }).catch(err => console.error('Error tracking:', err));
    
    // Buka modal
    openJurusanModal(title, dept, desc, image);
}
</script>

<style>
.jur-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.jur-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

/* Custom Scrollbar yang menarik */
.slider::-webkit-scrollbar {
    height: 8px;
}

.slider::-webkit-scrollbar-track {
    background: linear-gradient(to right, #e2e8f0, #f1f5f9);
    border-radius: 4px;
}

.slider::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #3b82f6 0%, #2563eb 100%);
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.slider::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #2563eb 0%, #1d4ed8 100%);
}

.slider {
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-gutter: stable;
}
</style>
