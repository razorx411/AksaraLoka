{{-- partials/footer.blade.php --}}
<footer class="bg-brand-bg border-t border-brand-border mt-12">
  <div class="max-w-5xl mx-auto px-5 py-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

    {{-- Brand --}}
    <div class="space-y-3">
      <span class="font-nunito font-black text-brand-theme text-lg">AksaraLoka</span>
      <p class="text-sm text-gray-500 font-semibold leading-relaxed">
        Platform belajar bahasa daerah Indonesia secara gratis, seru, dan efektif.
      </p>
      <div class="flex gap-2 pt-1">
        <a href="#" class="w-7 h-7 bg-brand-soft rounded-lg flex items-center justify-center text-brand-theme text-xs font-black hover:bg-brand hover:text-white transition-colors">𝕏</a>
        <a href="#" class="w-7 h-7 bg-brand-soft rounded-lg flex items-center justify-center text-brand-theme text-xs font-black hover:bg-brand hover:text-white transition-colors">f</a>
        <a href="#" class="w-7 h-7 bg-brand-soft rounded-lg flex items-center justify-center text-brand-theme text-xs font-black hover:bg-brand hover:text-white transition-colors">📸</a>
        <a href="#" class="w-7 h-7 bg-brand-soft rounded-lg flex items-center justify-center text-brand-theme text-xs font-black hover:bg-brand hover:text-white transition-colors">▶</a>
      </div>
    </div>

    {{-- Platform --}}
    <div class="space-y-3">
      <h3 class="text-brand font-black text-xs uppercase tracking-widest">Platform</h3>
      <ul class="space-y-1.5">
        <li><a href="#" class="text-sm text-gray-500 hover:text-brand font-semibold transition-colors">Tentang Kami</a></li>
        <li><a href="{{ route('materi') }}" class="text-sm text-gray-500 hover:text-brand font-semibold transition-colors">Materi</a></li>
      </ul>
    </div>

    {{-- Bantuan --}}
    <div class="space-y-3">
      <h3 class="text-brand font-black text-xs uppercase tracking-widest">Bantuan</h3>
      <ul class="space-y-1.5">
        <li><a href="{{ route('privasi') }}" class="text-sm text-gray-500 hover:text-brand font-semibold transition-colors">Kebijakan Privasi</a></li>
        <li><a href="#" class="text-sm text-gray-500 hover:text-brand font-semibold transition-colors">Hubungi Kami</a></li>
      </ul>
    </div>

    {{-- Tim --}}
    <div class="space-y-4">
      <div class="space-y-2">
        <h3 class="text-brand font-black text-xs uppercase tracking-widest">Kelompok 11</h3>
        <div class="flex flex-wrap gap-1.5">
          <span class="text-xs bg-brand-soft text-brand-theme font-bold px-2.5 py-1 rounded-full border border-brand-border">Dwiki</span>
          <span class="text-xs bg-brand-soft text-brand-theme font-bold px-2.5 py-1 rounded-full border border-brand-border">Zaki</span>
          <span class="text-xs bg-brand-soft text-brand-theme font-bold px-2.5 py-1 rounded-full border border-brand-border">Hafid</span>
        </div>
        <p class="text-xs text-gray-400 font-semibold leading-relaxed">
          Pembimbing:<br/>Bu Reisa Permatasari, ST, M.Kom.
        </p>
      </div>
    </div>

  </div>

  <div class="border-t border-brand-border bg-white">
    <div class="max-w-5xl mx-auto px-5 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-2">
      <p class="text-xs text-gray-400 font-semibold">&copy; {{ date('Y') }} AksaraLoka · Kelompok 11 · MPSI &amp; PemWeb</p>
      <span class="text-xs font-black text-brand-theme bg-brand-soft border border-brand-border px-3 py-1 rounded-full">
        Ayo Lestarikan Bahasa Daerah!
      </span>
    </div>
  </div>
</footer>
