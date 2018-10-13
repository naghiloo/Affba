<div class="col-md-3 col-xs-3">
    <div style="float: left;position: relative;padding: 5px;">
        <span id="profileCircleIcon" class="fa fa-user"></span>
        <ul id="usrNavMenu" class="row">
            <div class="arrow-top"></div>
            <li>
                <a href="{{ url('link') }}">
                    <span class="fa fa-link" style="line-height: 38px; margin-left: 5px;"></span>
                    <span>لینک های من</span>
                </a>
            </li>
            <?php /*
            <li>
                <a href="">
                    <span class="fa fa-user" style="line-height: 38px; margin-left: 5px;"></span>
                    <span>پروفایل کاربری</span>
                </a>
            </li>
            */ ?>
            <li>
                <a href="{{ URL::route('logout') }}">
                    <span class="fa fa-sign-out" style="line-height: 38px; margin-left: 5px;"></span>
                    <span>خروج</span>
                </a>
            </li>
        </ul>
    </div>
</div>