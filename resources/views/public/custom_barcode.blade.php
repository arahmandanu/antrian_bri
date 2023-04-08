@extends('shared.main_2')

@section('content')
    <div class="position-relative">
        <div class="position-absolute top-0 start-50 translate-middle-x mt-5">
            <table>
                <tr id="mycanvas">
                    <td class="text-center">
                        <div class="row justify-content-center p-5">
                            {!! $barcode !!}
                        </div>
                        <h6>URL: {{ env('APP_URL') }}</h6>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
