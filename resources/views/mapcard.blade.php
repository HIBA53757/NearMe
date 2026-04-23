<x-app-layout>
      
<div class="flex h-screen overflow-hidden">
    <div class="w-full md:w-1/2 lg:w-2/5 overflow-y-auto bg-gray-50 p-6" id="experience-container">
        <h2 class="text-2xl font-bold text-[#561c24] mb-6">Nearby Experiences</h2>
        
        <div id="experience-list" class="space-y-4">
           @foreach($experiences as $experience)
    <div class="experience-card bg-white rounded-xl shadow-sm border border-gray-100 p-4 transition hover:shadow-md cursor-pointer" 
         data-lat="{{ $experience->place->latitude ?? '' }}" 
         data-lng="{{ $experience->place->longitude ?? '' }}"
         data-location-id="{{ $experience->place_id }}">
        
        <img src="{{ $experience->photos->first() ? asset('storage/' . $experience->photos->first()->path) : 'https://via.placeholder.com/400x300' }}" 
             class="w-full h-40 object-cover rounded-lg mb-3">
             
        <h3 class="font-semibold text-lg">{{ $experience->title }}</h3>
        <p class="text-sm text-gray-500">{{ $experience->ambiance }} • {{ $experience->time_of_day }}</p>
        <p class="text-xs text-gray-400 mt-2">At: {{ $experience->place->name ?? 'Unknown Location' }}</p>
    </div>
@endforeach
        </div>
    </div>

    <div class="hidden md:block md:w-1/2 lg:w-3/5 h-full relative" id="map" style="z-index: 1;">
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const map = L.map('map').setView([35.167, -2.928], 13); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const cards = document.querySelectorAll('.experience-card');
   
    cards.forEach(card => {
        const lat = card.dataset.lat;
        const lng = card.dataset.lng;
        const locationId = card.dataset.locationId;

        if (lat && lng) {
          
            const marker = L.circleMarker([lat, lng], {
                color: '#561c24', // Your Deep Burgundy
                fillColor: '#561c24',
                fillOpacity: 0.8,
                radius: 8
            }).addTo(map);

            marker.on('click', function() {
                cards.forEach(c => {
                    if (c.dataset.locationId === locationId) {
                        c.classList.remove('hidden');
                        c.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else {
                        c.classList.add('hidden');
                    }
                });
     
                showResetButton();
            });
        }
    });
});

function showResetButton() {
    if(!document.getElementById('reset-map-filter')) {
        const btn = document.createElement('button');
        btn.id = 'reset-map-filter';
        btn.innerText = "Show all experiences";
        btn.className = "fixed bottom-10 left-10 z-[1000] bg-[#561c24] text-white px-4 py-2 rounded-full shadow-lg";
        btn.onclick = () => {
            document.querySelectorAll('.experience-card').forEach(c => c.classList.remove('hidden'));
            btn.remove();
        };
        document.body.appendChild(btn);
    }
}
</script>

</x-app-layout>