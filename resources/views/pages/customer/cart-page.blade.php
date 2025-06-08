@extends('layouts.cart')

@section('left')
<div class="flex justify-between mb-6">
  <div class="flex items-center gap-2 ">
    <img src="{{ asset('images/logofestify.png') }}" class="h-8 w-auto mr-2" alt="Festify Logo" />
    <h2 class="text-xl  font-semibold">Your Shopping Cart</h2>
  </div>
  <div class= "mr-6 icon-justify">
    <img src="https://cdn-icons-png.flaticon.com/512/833/833314.png"  alt="Icon Keranjang" width="32" height="32" />
  </div>
</div>




  {{-- Header Kolom --}}
  @include('components.cart-header')

  @php
    $items = [
      ['id' => 1, 'image' => 'lightstick.png', 'name' => 'Lightstick Seventeen', 'version' => 'Ver.2', 'selected' => true],
      ['id' => 2, 'image' => 'kursi.png', 'name' => 'Lightstick Seventeen', 'version' => 'Ver.2', 'selected' => false],
      ['id' => 3, 'image' => 'kamera.png', 'name' => 'Lightstick Seventeen', 'version' => 'Ver.2', 'selected' => true],
    ];
  @endphp

  @foreach($items as $item)
    @include('components.cart-item', ['item' => $item])
  @endforeach

  <a href="/" class="mt-6 inline-block text-sm text-black underline">
    ← Back To Shop
  </a>
@endsection

@section('right')
  @include('components.cart-details')
@endsection


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('select-all');
    const itemChecks = document.querySelectorAll('.item-check');

    function updateSummary() {
      let items = document.querySelectorAll('.cart-item');
      let subtotal = 0, itemCount = 0;

      items.forEach(item => {
        const checkbox = item.querySelector('.item-check');
        const count = parseInt(item.querySelector('.count').innerText);
        const price = parseInt(item.getAttribute('data-price'));

        if (checkbox.checked) {
          subtotal += price * count;
          itemCount += count;
        }
      });

      const shipping = parseInt(document.getElementById('shipping')?.value || 0);
      const voucherRate = parseFloat(document.getElementById('voucher')?.value || 0);

      let total = subtotal + shipping;
      total = total - (total * voucherRate);

      document.getElementById('item-count').innerText = `ITEMS ${itemCount}`;
      document.getElementById('item-subtotal').innerText = `IDR ${subtotal.toLocaleString()}`;
      document.getElementById('total-price').innerText = `IDR ${total.toLocaleString()}`;
    }

    // + / - Quantity
    document.querySelectorAll('.increment').forEach(btn => {
      btn.addEventListener('click', e => {
        const countEl = e.target.closest('.cart-item').querySelector('.count');
        countEl.innerText = parseInt(countEl.innerText) + 1;
        updateSummary();
      });
    });

    document.querySelectorAll('.decrement').forEach(btn => {
      btn.addEventListener('click', e => {
        const countEl = e.target.closest('.cart-item').querySelector('.count');
        let count = parseInt(countEl.innerText);
        if (count > 1) countEl.innerText = count - 1;
        updateSummary();
      });
    });

    // Remove Item
    document.querySelectorAll('.remove').forEach(btn => {
      btn.addEventListener('click', e => {
        e.target.closest('.cart-item').remove();
        updateSummary();
      });
    });

    // Sync checkbox change (item or voucher/shipping)
    document.querySelectorAll('.item-check, #shipping, #voucher').forEach(input => {
      input.addEventListener('change', () => {
        // Sinkronisasi: cek apakah semua item dicentang
        const allChecked = Array.from(itemChecks).every(c => c.checked);
        if (selectAll) selectAll.checked = allChecked;
        updateSummary();
      });
    });

    // Checkbox "select all"
    if (selectAll) {
      selectAll.addEventListener('change', function () {
        itemChecks.forEach(cb => cb.checked = selectAll.checked);
        updateSummary();
      });
    }

    updateSummary(); // inisialisasi awal
  });
</script>
