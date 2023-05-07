<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectAll = selector("#selectAll");
        const checkboxes = document.querySelectorAll(".checkbox-select");
        selectAll.addEventListener("click", function(event) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAll.checked;
            });
            checking();
        });
    });

    function read() {
        var checkboxes = document.getElementsByClassName('checkbox-select');
        var selectedValues = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) selectedValues.push(checkboxes[i].value);
        }
        if (selectedValues) {
            $.ajax({
                type: 'GET',
                url: "{{ route($multiple_check_url) }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    selectedValues,
                },
                success: function(data) {
                    if (data.status === 'success') window.location.reload()
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                }
            });

        }
    }

    function checking() {
        var checkboxes = document.getElementsByClassName('checkbox-select');
        var selectedValues = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) selectedValues.push(checkboxes[i].value);
        }
        if (selectedValues.length) {
            selector('#actionOption').style.display = 'block'
            selector('.totalCheck').innerText = selectedValues.length
        } else {
            selector('#actionOption').style.display = 'none'
        }
    }
</script>
