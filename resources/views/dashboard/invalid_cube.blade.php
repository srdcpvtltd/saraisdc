@foreach ($data->slice(0, 2) as $row)
<tr >
    <td><a href="{{ asset(url('/admin/guest/detail/'.$row->id)) }}">{{$row->gues_name}}</a></td>
    <td>{{(isset($row->state)) ? $row->state->name : ''}}</td>
    <td>{{(isset($row->city)) ? $row->city->name : ''}}</td>
    <td>{{(isset($row->hotelProfile)) ? $row->hotelProfile->hotel_name : ''}}</td>
</tr>
@endforeach


