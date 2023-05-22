<div class="input-group-append" id="actionOption" style="display: none">
    <span class="btn btn-sm mt-1 mb-1 btn-secondary  mr-2" onclick="read()">Make <span class="totalCheck"></span>
        Seen</span>
</div>
<div class="input-group-append p-0 m-0 mr-2">
    <select id="pageData" onchange="pageNumberSet()">
        @foreach ([10, 20, 30, 40, 50] as $pData)
            <option value="{{ $pData }}" @if ($pData === $pageData) selected @endif>
                {{ $pData }} Per Page</option>
        @endforeach
    </select>
</div>
