<div class="gold_summery_table" id="{{ $div_id }}"> 
  <table>
    <tbody class="text-center">
        <tr>
          <td colspan="2" class="font-weight-bold">{{ $title }}</td>
        </tr>
        <tr>
          <td>Today {{ @$typeName }} Rate in {{ @city }} (Rs.)</td>
          <td> 
            <span class="data-value-big {{$class_style}}"> {{ $today_rate }} <i class="fas {{ $arrowclass }} data-value-big-icon {{$class_style}}"></i></span>
          </td>
        </tr>
        <tr>
          <td>Yesterday {{ @$typeName }} Rate in {{ $city }} (Rs.)</td>
          <td>{{ $yesterday_rate }}</td>
        </tr>
        <tr>
          <td>Change (Rs.)</td>
          <td><span class="{{$class_style}}">{{ $diff }}</span></td>
        </tr>
        <tr>
          <td>Change (%)</td>
          <td><span class="{{$class_style}}">{{ round( $diff_per, 2 ) }}%</span></td>
        </tr>
    </tbody>
  </table>
</div>