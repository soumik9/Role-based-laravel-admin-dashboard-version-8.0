<li class="nav-item d-none d-md-block">
    <a class="nav-link" href="javascript:void(0)">
        <div class="customize-input">
            <select
                class="custom-select form-control bg-white custom-radius custom-shadow border-0" onchange="location = this.value;">
                <option {{ Session::get('locale') === "bn" ? "selected" : "" }} value="{{ route('setlocale','bn') }}">বাংলা</option>
                <option {{ Session::get('locale') === "en" ? "selected" : "" }} value="{{ route('setlocale','en') }}">English</option>
            </select>
        </div>
    </a>
</li>