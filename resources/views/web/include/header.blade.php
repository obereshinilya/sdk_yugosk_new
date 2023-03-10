<div class="header_inside">
    <div class="user_profile">
        <img alt="Пользователь" src="{{ asset('assets/images/user.jpg') }}" class="user_avatar">
        <div class="user_info">
            @guest
                <p></p>
                <p class="white_text user_name">
                    <a class="logout" href="{{ route('login') }}">{{ __('Login') }}</a>
                </p>

            @else
                <a class="logout" href="{{ route('changepwd') }}">
                    <p class="white_text user_name">{{ Auth::user()->name }}</p>
                </a>
                <a class="logout" href="{{ route('logout') }}">
                    {{ __('Logout') }}
                </a>
            @endguest
        </div>
    </div>
    <div class="time_block">
        <p id="time"></p>
    </div>
</div>

<script>
    function updateTime() {
        var newDate = new Date();
        newDate.setMilliseconds(5 * 60 * 60 * 1000);  // +3 часа

        let dd = newDate.getDate();
        if (dd < 10) dd = '0' + dd;

        let mm = newDate.getMonth() + 1;
        if (mm < 10) mm = '0' + mm;

        let yyyy = newDate.getFullYear();
        document.getElementById('time').textContent = dd + '.' + mm + '.' + yyyy + ' ' + newDate.toISOString().split('T')[1].split('.')[0]
        // newDate.toISOString().split('T')[0] + ' ' + newDate.toISOString().split('T')[1].split('.')[0];
    }

    setInterval(updateTime, 1000);

</script>
