@php
    $order_data = json_decode($order_data, true);
@endphp
<x-mail::message>
# Order Confirmation

Your order has been successfully
Here are detail informations:

<ul>
    @foreach ($order_data as $item)
        <li>
          Movie name:  {{ $item['movie_name'] }}
        </li>
        <li>
          Seat:  {{ $item['seat_code'] }}
        </li>
        <li>
          Customer name:  {{ $item['cus_name'] }}
        </li>
        <li>
          Customer email:  {{ $item['cus_email'] }}
        </li>
        <hr>
        <li>
          <strong>Total: {{ $item['ticket_fee_total'] }}$</strong> 
        </li>
    @endforeach
</ul>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
