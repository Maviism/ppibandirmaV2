<div class="px-4 mb-10 lg:px-44 2xl:px-96">
  <div class="mx-5 mb-5 text-2xl text-center font-semibold">Frequently Ask Question (FAQ)</div>
  @foreach($faqs as $faq)
  <details class="m-2 rounded shadow-lg p-4 [&_svg]:open:-rotate-180">
    <summary class="flex justify-between cursor-pointer list-none items-center gap-4">
      <div class="font-bold">{{ $faq->question }}</div>
      <div>
        <svg class="rotate-0 transform text-gray-700 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
          <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
      </div>
    </summary>
      <div class="mt-2 transition-max-h duration-300 max-h-screen overflow-hidden">
        {!! $faq->answer !!}
      </div>
  </details>
  @endforeach
  
</div>
