{{-- partials/footer-landing.blade.php --}}
<footer class="w-full bg-brand-surface border-t-2 border-brand-border mt-16">
  <div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-10">

    <div class="flex flex-col gap-3">
      <span class="font-nunito text-brand font-extrabold text-xl tracking-tight cursor-default select-none">AksaraLoka</span>
      <p class="text-sm text-gray-500 leading-relaxed cursor-default select-none">
        Platform belajar bahasa daerah yang gratis, seru, dan efektif untuk semua kalangan.
      </p>
    </div>

    <div class="flex flex-col gap-3">
      <h3 class="text-brand font-extrabold text-sm uppercase tracking-widest cursor-default select-none">Tim Pengembang</h3>
      <ul class="flex flex-col gap-1">
        @foreach (['Dwiki Aulia Rahman', 'Zaki Wira Laksamana', 'Hafid Fathurrohman'] as $name)
        <li class="flex items-center gap-2 text-sm text-gray-600 cursor-default select-none">
          <span class="w-1.5 h-1.5 rounded-full bg-brand inline-block"></span>{{ $name }}
        </li>
        @endforeach
      </ul>
    </div>

    <div class="flex flex-col gap-3">
      <h3 class="text-brand font-extrabold text-sm uppercase tracking-widest cursor-default select-none">Dosen Pembimbing</h3>
      <p class="text-sm text-gray-600 leading-relaxed cursor-default select-none">Bu Reisa Permatasari, ST, M.Kom.</p>
      <p class="text-xs text-gray-400 font-semibold uppercase tracking-widest mt-1 cursor-default select-none">
        Pemrograman Website &amp; Manajemen Proyek Sistem Informasi · {{ date('Y') }}
      </p>
    </div>

  </div>

  <div class="border-t border-brand-border bg-brand-soft">
    <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
      <p class="text-xs text-gray-400 font-semibold cursor-default select-none">&copy; {{ date('Y') }} AksaraLoka — Kelompok 11</p>
    </div>
  </div>
</footer>
