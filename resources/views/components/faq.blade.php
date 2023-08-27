<!-- Tab links -->
<div class="px-4 lg:px-44 2xl:px-96">
  <div class="mx-5 mb-5 text-2xl font-semibold">Frequently Ask Question (FAQ)</div>
  <div class="tab h-10 border bg-slate-50 flex items-stretch">
    <button id="defaultOpen" class="tablinks px-5 text-white " onclick="openCity(event, 'General')">General</button>
    <button class="tablinks px-5" onclick="openCity(event, 'Bandirma')">Bandirma</button>
    <button class="tablinks px-5" onclick="openCity(event, 'Canakkale')">Çanakkale</button>
  </div>
  
  <!-- Tab content -->
  <div id="General" class="tabcontent p-4 divide-y-2 ">
    <details class="">
      <summary class="cursor-pointer">Sistem penilaian kuliah di Turki</summary>
      <div class="pl-4 py-2">
        Saat ini turki menerapksan sistem Bologna Process pada sistem pendidikannya. Bologna Process adalah sistem pendidikan yang setara denan negara di Eropa dalam hal pengakuan gelar, jaminan kualitas pendidikan, dan sistem akreditasi terbaru yang di universalkan oleh european unio.
      </div>
    </details>
    <details class="">
      <summary>Bahasa apa yang digunakan untuk perkuliahan?</summary>
      <div class="pl-4 py-2">
        <p>Tergantung.</p>
      </div>
    </details>
    <details class="">
      <summary>Nanti transfer bulanannya gimana ya?</summary>
      <div class="pl-4 py-2">
        <p>Tergantung.</p>
      </div>
    </details>
  </div>
  
  <div id="Bandirma" class="tabcontent p-4 divide-y-2">
    <details>
      <summary>Gimana cara bayar uang kuliah?</summary>
      <p>TF ke gueeee</p>
    </details>
    <details>
      <summary>Gimana cara ganti jurusan</summary>
      <p>Ada dua cara untuk berkuliah diturki dengan jalur mandiri dan beasiswa
    </details>
  </div>
  
  <div id="Canakkale" class="tabcontent p-4 divide-y-2">
    <details>
      <summary>Gimana cara bayar uang kuliah?</summary>
      <p>Ada dua cara untuk berkuliah diturki dengan jalur mandiri dan beasiswa
    </details>
    <details>
      <summary>Gimana cara ganti jurusan</summary>
      <p>Ada dua cara untuk berkuliah diturki dengan jalur mandiri dan beasiswa
    </details>
  </div>  
</div>

@push('scripts')
<script>
  document.getElementById("defaultOpen").click();

  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" bg-blue-500", "");
      tablinks[i].className = tablinks[i].className.replace(" text-white", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " bg-blue-500";
    evt.currentTarget.className += " text-white";
}
</script>
@endpush