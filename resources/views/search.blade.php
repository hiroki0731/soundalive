@extends('layouts.app')

@section('content')
    <div id="mypage" class="mypage-wrapper">
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="card-header">検索条件選択</div>
                    <div class="card-body">
                        <label>日付を指定</label>
                        <input type="date" name="date" value="">

                        <label>エリアを指定</label>
                        <select name="pref" id="pref" onChange="setMenuItem(false, this[this.selectedIndex].value)">
                            <option value="0" selected>都道府県を選択</option>
                            @foreach(Helper::getPref() as $key => $val)
                                <option value={{ $key }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        <select name="line" id="line" onChange="setMenuItem(true, this[this.selectedIndex].value)">
                            <option selected>路線を選択
                        </select>
                        <select name="station" id="station">
                            <option selected>駅を選択
                        </select>

                        <label>ジャンルを指定</label>
                        <select name="music_type" id="music_type">
                            <option value="0" selected>音楽ジャンルを選択</option>
                            @foreach(Helper::getMusicType() as $key => $val)
                                <option value={{ $key }}>{{ $val }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="card">
                    <div class="card-header">検索結果一覧</div>

                    <div class="card-body">
                        @foreach($concerts as $concert)
                            @php
                                $detail_info = json_decode($concert->detail_info);
                            @endphp
                            <div class="mypage-concert-list-wrapper">
                                <div class="row mypage-concert-list pointer">
                                    <div class="col-md-3">
                                        <img src={{ asset('storage/images/'. $detail_info->concert_img) }} style="width:100%">
                                    </div>
                                    <div class="col-md-9">
                                        <p>タイトル：{{ $detail_info->concert_name }}</p>
                                        <p>バンド名：{{ $detail_info->band_name }}</p>
                                        <p>開催日：{{ $detail_info->concert_date }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{--<p>{{ $concerts->links() }}</p>--}}

                        @if (empty($concerts) || count($concerts) === 0)
                            <p>検索結果なし</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/area.js') }}"></script>
@endsection