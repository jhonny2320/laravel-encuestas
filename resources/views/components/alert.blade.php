@props(['type'=> 'info'])
@php
    switch ($type) {
        case 'info':
            $class = 'bg-blue-100 text-blue-800 text-sm font-medium dark:bg-blue';
            break;
        case 'success':
            $class = 'bg-green-100 text-green-800 text-sm font-medium dark:bg-green';
            break;
        case 'warning':
            $class = 'bg-yellow-100 text-yellow-800 text-sm font-medium dark:bg-yellow';
            break;
        case 'danger':
        $class = 'bg-red-100 text-red-800 text-sm font-medium dark:bg-red';
            break;
        default:
            # code...
            break;
    }
@endphp
<div class="p-4 text-sm rounded-lg {{$class}}" role="alert">
    <span> {{$titulo ?? 'Informacion'}}</span><p>{{$slot}}</p>
</div>