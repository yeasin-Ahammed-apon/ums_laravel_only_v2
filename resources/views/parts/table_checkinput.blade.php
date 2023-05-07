<td>
    @if ($data->seen)
        <div class="form-check">
            <input type="checkbox" value="{{ $data->id }}" class="form-check-input" checked
                disabled>
        </div>
    @else
        <div class="form-check">
            <input type="checkbox" name="checked" value="{{ $data->id }}"
                class="checkbox-select form-check-input" onclick="checking()">
        </div>
    @endif
</td>
