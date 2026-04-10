<footer class="bg-[#1A1A1A] text-white py-8 md:py-12 mt-12 font-[Poppins]" x-data="{ modalOpen: false, modalTitle: '', modalDept: '', modalDesc: '', modalImage: '' }" x-on:open-modal.window="modalOpen = true; modalTitle = $event.detail.title; modalDept = $event.detail.dept; modalDesc = $event.detail.desc; modalImage = $event.detail.image">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-6 md:gap-8 lg:gap-12 justify-between">
            <!-- School Info -->
            <div class="w-full lg:w-1/4">
                <a href="/" class="inline-block">
                    <img class="h-12 md:h-16 mb-3 md:mb-4" src="{{ $assetBase . '/assets/skariga logo 1.png' }}"
                        loading="lazy" alt="School Logo">
                </a>
                <p class="text-[#B9B9B9] text-sm md:text-lg font-bold mb-2">Success By Discipline</p>
                <div class="h-px w-full bg-gray-700 mb-3 md:mb-4"></div>

                <div class="flex items-start py-2" title="Nomor Telepon">
                    <i class="fas fa-phone-alt text-gray-500 mt-0.5 mr-2 text-xs md:text-base"></i>
                    <span class="text-[#828282] text-xs md:text-sm">(0341) 554383</span>
                </div>

                <div class="flex items-start py-2" title="WhatsApp">
                    <i class="fab fa-whatsapp text-gray-500 mt-0.5 mr-2 text-xs md:text-base"></i>
                    <a href="https://wa.me/6282133000370"
                        class="text-[#828282] text-xs md:text-sm underline break-words">+62 821-3300-0370</a>
                </div>

                <div class="flex items-start py-2" title="Email">
                    <i class="fas fa-envelope text-gray-500 mt-0.5 mr-2 text-xs md:text-base"></i>
                    <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=mail.smkpgri3malang@gmail.com"
                        class="text-[#828282] text-xs md:text-sm underline break-words">
                        mail.smkpgri3malang@gmail.com
                    </a>
                </div>
            </div>

            <!-- About School -->
            <div class="w-full lg:w-1/4">
                <h3 class="text-[#B9B9B9] text-base md:text-xl font-bold mb-3 md:mb-4">Tentang Sekolah</h3>
                <ul class="space-y-1 md:space-y-2">
                    <li><a href="/" class="text-[#828282] hover:text-white transition text-xs md:text-base">Beranda</a>
                    </li>
                    <li><a href="/berita"
                            class="text-[#828282] hover:text-white transition text-xs md:text-base">Berita</a></li>
                    <li><a href="/profil" class="text-[#828282] hover:text-white transition text-xs md:text-base">Profil
                            Sekolah</a></li>
                    <li><a href="/jurusan"
                            class="text-[#828282] hover:text-white transition text-xs md:text-base">Jurusan</a></li>
                    <li><a href="/prestasi"
                            class="text-[#828282] hover:text-white transition text-xs md:text-base">Prestasi</a></li>
                </ul>
            </div>

            <!-- Information & Services -->
            <div class="w-full lg:w-1/4">
                <h3 class="text-[#B9B9B9] text-base md:text-xl font-bold mb-3 md:mb-4">Informasi & Layanan</h3>
                <ul class="space-y-1 md:space-y-2">
                    <li><a href="/ekstrakurikuler"
                            class="text-[#828282] hover:text-white transition text-xs md:text-base">Ekstrakurikuler</a>
                    </li>
                    <li><a href="/alumni"
                            class="text-[#828282] hover:text-white transition text-xs md:text-base">Alumni</a></li>
                    <li><a href="/Pendaftaran"
                            class="text-[#828282] hover:text-white transition text-xs md:text-base">Pendaftaran</a></li>
                </ul>
            </div>

            <!-- Social Media & Map -->
            <div class="w-full lg:w-1/4">
                <div class="flex flex-row items-start gap-4 md:gap-6">
                    <!-- Social Media Icons -->
                    <div class="flex flex-col gap-3 md:gap-5">
                        <!-- YouTube -->
                        <a href="https://www.youtube.com/channel/UCGGVdb_Wh1lvn8HIoMKdiLA"
                            class="w-8 h-8 md:w-10 md:h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-red-600 transition"
                            title="YouTube">
                            <i class="fab fa-youtube text-sm md:text-lg text-gray-300"></i>
                        </a>
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/skariga_official"
                            class="w-8 h-8 md:w-10 md:h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-customInsta transition"
                            title="Instagram">
                            <i class="fab fa-instagram text-sm md:text-lg text-gray-300"></i>
                        </a>
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/SKARIGA/?locale=id_ID"
                            class="w-8 h-8 md:w-10 md:h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-700 transition"
                            title="Facebook">
                            <i class="fab fa-facebook-f text-sm md:text-lg text-gray-300"></i>
                        </a>
                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/@skariga"
                            class="w-8 h-8 md:w-10 md:h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-black transition"
                            title="TikTok">
                            <i class="fa-brands fa-tiktok text-sm md:text-lg text-gray-300"></i>
                        </a>
                    </div>

                    <!-- Google Maps -->
                    <div class="flex-1 h-[150px] md:h-[220px] rounded-lg overflow-hidden">
                        <iframe title="SMK PGRI 3 MALANG" width="100%" height="100%"
                            style="border:1px; border-radius: 8px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?width=100%&amp;height=220&amp;hl=en&amp;q=smk pgri 3 malang&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 mt-6 md:mt-8 pt-4 md:pt-6 text-center text-gray-500 text-xs md:text-sm">
            <p>&copy; {{ date('Y') }} SMK PGRI 3 Malang. All rights reserved.</p>
        </div>
    </div>

    <!-- Jurusan Modal -->
    <div x-show="modalOpen" x-cloak class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="modalOpen = false"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block align-middle bg-white rounded-2xl shadow-2xl transform transition-all sm:my-8 sm:max-w-2xl w-full mx-4 overflow-hidden">
                <!-- Modal Image -->
                <div class="relative h-64 sm:h-80">
                    <img :src="modalImage" :alt="modalTitle" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <button @click="modalOpen = false" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 text-white rounded-full w-10 h-10 flex items-center justify-center transition">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="absolute bottom-6 left-6">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-14" :class="modalDept === 'OTOMOTIF' ? 'bg-red-500' : modalDept === 'TIK' ? 'bg-purple-500' : modalDept === 'ELEKTRO' ? 'bg-yellow-500' : 'bg-blue-500'"></div>
                            <div>
                                <h3 class="text-2xl font-bold text-white" x-text="modalTitle"></h3>
                                <p class="text-gray-200" x-text="modalDept"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="p-6 sm:p-8">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi Jurusan</h4>
                    <p class="text-gray-600 leading-relaxed" x-text="modalDesc"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    function openJurusanModal(title, dept, desc, image) {
        window.dispatchEvent(new CustomEvent('open-modal', {
            detail: { title, dept, desc, image }
        }));
    }
    </script>
</footer>