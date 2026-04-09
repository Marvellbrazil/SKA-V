declare global {
    interface globalThis {
        Alpine: typeof Alpine;
        showNews: (index: number) => void;
        initializeNewsSlider: () => void;
        beritas: any[];
    }
}

import "../css/app.css";
import Alpine from "alpinejs";
import Swiper from "swiper";
import { Autoplay, Pagination, Navigation, EffectFade } from "swiper/modules";
import { initChartGabungan, initJurusanChart } from "./chart";
import { initScrollButtons } from "./scroll";
import MicroModal from "micromodal";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/effect-fade";

// Variabel global
let newsSwiper: Swiper | null = null;
let allBeritas: any[] = [];

// ✅ Mobile menu
const initMobileMenu = (): void => {
    const hamburger = document.getElementById("hamburger");
    const navMenu = document.getElementById("navMenu");

    if (hamburger && navMenu) {
        hamburger.addEventListener("click", (): void => {
            hamburger.classList.toggle("active");
            navMenu.classList.toggle("active");
        });
    }
};

// ✅ Initialize News Slider dengan data berita
const initializeNewsSlider = (): void => {
    // console.log("🔄 Initializing news slider...");

    try {
        // Ambil data berita dari globalThis object
        const beritasData = globalThis.beritas;
        // console.log("📊 Beritas data:", beritasData);

        allBeritas = beritasData;
        // console.log(`📰 Found ${allBeritas.length} beritas`);

        // Setup Swiper container
        const swiperWrapper = document.getElementById("x-headnews");

        // Clear existing content
        swiperWrapper.innerHTML = "";

        // Create slides untuk setiap berita
        allBeritas.forEach((berita: any, index: number) => {
            const slide = document.createElement("div");
            slide.className = "swiper-slide relative w-full h-full";

            // Handle image path
            let imagePath = berita.gambar;
            if (
                !imagePath.startsWith("storage/") &&
                !imagePath.startsWith("http")
            ) {
                imagePath = `storage/${berita.gambar}`;
            }

            slide.innerHTML = `
                <a href="/berita/${berita.id}">
                    <img src="${imagePath}" alt="${berita.title}"
                        class="headnews-img w-full h-[40vh] sm:h-[50vh] md:h-[60vh] lg:h-[70vh] object-cover"
                        onerror="this.src='https://placehold.co/600x400'"/>
                    <div class="absolute bottom-0 left-0 w-full h-1/2 gradient-overlay"></div>
                    <div class="absolute bottom-6 left-5 md:left-8 text-white max-w-4xl">
                        <h1 class="title text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-2">
                            ${berita.title.toUpperCase()}
                        </h1>
                        <p class="desc text-base sm:text-lg md:text-xl lg:text-2xl font-bold mb-6 line-clamp-3">
                            ${berita.deskripsi}
                        </p>
                    </div>
                </a>
            `;
            swiperWrapper.appendChild(slide);
        });

        // Initialize Swiper
        initializeSwiperInstance();

        // console.log("✅ News slider initialized successfully");
    } catch (error) {
        // console.error("❌ Error initializing news slider:", error);
        createDefaultSlide();
    }
};

const createDefaultSlide = (): void => {
    const swiperWrapper = document.getElementById("x-headnews");
    if (!swiperWrapper) return;

    swiperWrapper.innerHTML = `
        <div class="swiper-slide relative w-full h-full">
            <img src="https://placehold.co/600x400" alt="Default News"
                class="headnews-img w-full h-[40vh] sm:h-[50vh] md:h-[60vh] lg:h-[70vh] object-cover" />
            <div class="absolute bottom-0 left-0 w-full h-1/2 gradient-overlay"></div>
            <div class="absolute bottom-6 left-5 md:left-8 text-white max-w-4xl">
                <h1 class="title text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-2">
                    SELAMAT DATANG DI SMK PGRI 3 MALANG
                </h1>
                <p class="desc text-base sm:text-lg md:text-xl lg:text-2xl font-bold mb-6">
                    Success by Discipline - Mengutamakan Kedisiplinan untuk Meraih Kesuksesan
                </p>
            </div>
        </div>
    `;

    initializeSwiperInstance();
};

// ✅ Initialize Swiper instance - FIXED
const initializeSwiperInstance = (): void => {
    const swiperEl = document.querySelector(".mySwiper");
    if (!swiperEl) {
        // console.error("❌ Swiper element (.mySwiper) not found");
        return;
    }

    // Destroy existing Swiper instance
    if (newsSwiper) {
        newsSwiper.destroy(true, true);
        newsSwiper = null;
    }

    try {
        newsSwiper = new Swiper(".mySwiper", {
            modules: [Navigation, Pagination, Autoplay, EffectFade],
            loop: allBeritas.length > 1,
            autoplay:
                allBeritas.length > 1
                    ? {
                          delay: 5000,
                          disableOnInteraction: false,
                      }
                    : false,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            effect: "fade",
            fadeEffect: {
                crossFade: true,
            },
            speed: 1000,
            on: {
                init: function () {
                    // console.log("✅ Swiper initialized successfully");
                },
            },
        });
    } catch (error) {
        // console.error("❌ Error initializing Swiper:", error);
    }
};

const showNews = (beritaId: string | number): void => {
    // Cari index berdasarkan ID berita
    const index = allBeritas.findIndex((berita) => berita.id == beritaId);

    if (index >= 0 && index < allBeritas.length) {
        try {
            globalThis.scrollTo({ top: 0, behavior: "smooth" });
            newsSwiper.slideTo(index);
        } catch (error) {
            // console.error(`❌ Error navigating to slide ${index}:`, error);
        }
    } else {
        // console.error(`❌ Invalid ID or not found: ${beritaId}`);
    }
};

// ✅ Initialize regular Swiper (untuk swiper lainnya jika ada)
const initSwiper = (): void => {
    const swiperEl = document.querySelector(".mySwiper");
    if (!swiperEl) return;

    if (document.getElementById("x-headnews")) {
        // console.log("📰 News swiper will be handled by initializeNewsSlider");
        return;
    }

    // Fallback untuk swiper biasa
    try {
        new Swiper(".mySwiper", {
            modules: [Navigation, Pagination, Autoplay, EffectFade],
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            effect: "fade",
            speed: 1000,
        });
    } catch (error) {
        // console.error("❌ Error initializing regular Swiper:", error);
    }
};

// ✅ Inisialisasi Micromodal
MicroModal.init({
    disableScroll: true,
    awaitOpenAnimation: true,
    awaitCloseAnimation: true,
});

// ✅ Event listener global untuk semua tombol modal
document.addEventListener("click", (e) => {
    const trigger = (e.target as HTMLElement).closest(
        "[data-micromodal-trigger]"
    ) as HTMLElement | null;
    if (!trigger) return;

    const title = trigger.dataset.title || "Tanpa Judul";
    const content = trigger.dataset.content || "Tidak ada konten.";
    const image = trigger.dataset.image || "/assets/default.svg";

    const modalTitle = document.getElementById("modalTitle");
    const modalContent = document.getElementById("modalContent");
    const modalImage = document.getElementById(
        "modalImage"
    ) as HTMLImageElement;

    if (modalTitle) modalTitle.textContent = title;
    if (modalContent) modalContent.innerHTML = content;
    if (modalImage) modalImage.src = image;

    MicroModal.show("newsModal");
});

// ✅ INIT based-on DOMContentLoaded Event Listener
document.addEventListener("DOMContentLoaded", (): void => {
    // console.log("🏫 SMK PGRI 3 Malang - Initializing...");

    // Export functions ke global scope
    globalThis.showNews = showNews;
    globalThis.initializeNewsSlider = initializeNewsSlider;

    // Initialize semua components
    globalThis.Alpine = Alpine;
    Alpine.start();

    initMobileMenu();
    initializeNewsSlider();
    initSwiper();
    initScrollButtons();
    initChartGabungan();
    initJurusanChart();
});

export { showNews, initializeNewsSlider };
