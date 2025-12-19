/**
 * Branch Map (Leaflet)
 * Data source: #map[data-branches]
 */

(function () {
    'use strict';

    window.addEventListener('load', function () {
        const mapEl = document.getElementById('map');

        console.log('mapEl:', mapEl);
        console.log('Leaflet L:', typeof L);

        if (!mapEl || typeof L === 'undefined') return;

        let branches = [];

        try {
            branches = JSON.parse(mapEl.dataset.branches || '[]');
        } catch (e) {
            console.error('Invalid branches JSON');
            return;
        }

        if (!branches.length) return;

        // ====== TIỆN ÍCH ======
        const isMobile = () =>
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            );

        function buildDirectionsUrl(lat, lng, addr) {
            return isMobile()
                ? `geo:${lat},${lng}?q=${encodeURIComponent(addr || '')}`
                : `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
        }

        // ====== KHỞI TẠO MAP ======
        const map = L.map(mapEl, {
            zoomControl: true,
            scrollWheelZoom: false
        });

        // Click vào map → bật zoom
        mapEl.addEventListener('click', () => {
            map.scrollWheelZoom.enable();
        });

        // Rời map → tắt zoom
        mapEl.addEventListener('mouseleave', () => {
            map.scrollWheelZoom.disable();
        });

        const baseLayers = {
            light: L.tileLayer(
                'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
                { maxZoom: 19, attribution: '&copy; OpenStreetMap & CARTO' }
            ),
            dark: L.tileLayer(
                'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',
                { maxZoom: 19, attribution: '&copy; OpenStreetMap & CARTO' }
            ),
            satellite: L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                { maxZoom: 19, attribution: '&copy; Esri, Maxar' }
            ),
        };

        baseLayers.light.addTo(map);

        // ====== ICON SCALE ======
        const BASE_ICON_WIDTH = 50;
        const BASE_ICON_HEIGHT = 50;

        const containerWidth = mapEl.clientWidth || 1200;
        const targetIconWidth = containerWidth * 0.04;
        const scale = targetIconWidth / BASE_ICON_WIDTH;

        // ====== ICON SVG ======
        const pinNormal = L.divIcon({
            className: '',
            iconSize: [
                Math.round(BASE_ICON_WIDTH * scale),
                Math.round(BASE_ICON_HEIGHT * scale),
            ],
            html: `<svg width="100%" viewBox="0 0 74 88" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M36.667 0C56.9171 0.000173798 73.3327 16.2805 73.333 36.3633C73.333 51.4216 61.1173 63.5407 36.6855 87.7705L36.667 87.79L36.6475 87.7705C12.2159 63.5408 2.57883e-05 51.4216 0 36.3633C0.000259864 16.2804 16.4167 0 36.667 0ZM36.667 26.7051C33.8193 26.7051 31.5107 28.9942 31.5107 31.8184C31.5107 34.6425 33.8193 36.9316 36.667 36.9316C39.5147 36.9316 41.8232 34.6425 41.8232 31.8184C41.8232 28.9942 39.5147 26.7051 36.667 26.7051Z" fill="#42525F"/>
      </svg>`,
        });

        const pinActive = L.divIcon({
            className: '',
            iconSize: [
                Math.round(BASE_ICON_WIDTH * scale),
                Math.round(BASE_ICON_HEIGHT * scale),
            ],
            html: `<svg width="100%" viewBox="0 0 74 88" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M36.667 0C56.9171 0.000173798 73.3327 16.2805 73.333 36.3633C73.333 51.4216 61.1173 63.5407 36.6855 87.7705L36.667 87.79L36.6475 87.7705C12.2159 63.5408 2.57883e-05 51.4216 0 36.3633C0.000259864 16.2804 16.4167 0 36.667 0ZM36.667 26.7051C33.8193 26.7051 31.5107 28.9942 31.5107 31.8184C31.5107 34.6425 33.8193 36.9316 36.667 36.9316C39.5147 36.9316 41.8232 34.6425 41.8232 31.8184C41.8232 28.9942 39.5147 26.7051 36.667 26.7051Z" fill="#008DFF"/>
      </svg>`,
        });

        // ====== RENDER LIST & MARKERS ======
        const listEl = document.getElementById('branchList');
        const markers = [];
        let activeIndex = null;
        const bounds = L.latLngBounds();

        branches.forEach((b, i) => {
            // List
            const row = document.createElement('div');
            row.className = 'm-marker';
            row.innerHTML = `
        <span class="m-marker__dot"></span>
        <div>
          <div class="m-marker__title">${b.name}</div>
          <div class="m-marker__meta">${b.addr || ''}</div>
        </div>
        <span class="spacer"></span>
        <a class="btn-link"
           href="${buildDirectionsUrl(b.lat, b.lng, b.addr)}"
           target="_blank"
           onclick="event.stopPropagation()">📍</a>
      `;
            listEl.appendChild(row);

            // Marker
            const marker = L.marker([b.lat, b.lng], { icon: pinNormal }).addTo(map);
            marker.bindPopup(`
        <h4 class="f-title">${b.name}</h4>
        <div class="f-text">${b.addr || ''}</div>
        <a class="f-btn" href="${buildDirectionsUrl(b.lat, b.lng, b.addr)}" target="_blank">
          🧭&nbsp;&nbsp; Mở chỉ đường
        </a>
      `);

            markers.push(marker);
            bounds.extend(marker.getLatLng());

            row.addEventListener('click', () => focusBranch(i));
            marker.on('click', () => focusBranch(i));
        });

        map.fitBounds(bounds, { padding: [30, 30] });

        function focusBranch(i) {
            if (activeIndex !== null && listEl.children[activeIndex]) {
                listEl.children[activeIndex].classList.remove('active');
            }

            markers.forEach(m => m.setIcon(pinNormal));

            activeIndex = i;
            const b = branches[i];
            const m = markers[i];

            listEl.children[i].classList.add('active');
            m.setIcon(pinActive);

            map.flyTo([b.lat, b.lng], Math.max(map.getZoom(), b.zoom || 16), {
                duration: 0.6,
            });
            m.openPopup();
        }

        // ====== NÚT ĐỔI NỀN MAP ======
        const layerControl = L.control({ position: 'topright' });
        layerControl.onAdd = function () {
            const div = L.DomUtil.create('div', 'map-style-control');
            div.innerHTML = `
        <button class="map-style-btn active" data-style="light">🌞 Sáng</button>
        <button class="map-style-btn" data-style="dark">🌙 Tối</button>
        <button class="map-style-btn" data-style="satellite">🛰️ Vệ tinh</button>
      `;
            div.addEventListener('click', e => {
                const style = e.target.dataset.style;
                if (!style) return;

                div.querySelectorAll('button').forEach(b => b.classList.remove('active'));
                e.target.classList.add('active');

                Object.values(baseLayers).forEach(l => map.removeLayer(l));
                baseLayers[style].addTo(map);
            });
            return div;
        };
        layerControl.addTo(map);
    });
})();
