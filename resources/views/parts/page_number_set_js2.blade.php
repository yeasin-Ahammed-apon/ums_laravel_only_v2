<script>
function pageNumberSet() {
    var pageData = document.getElementById("pageData").value;
    $.ajax({
        type: 'GET',
        url: "{{ route($page_number_url,[$p1,$p2]) }}",
        data: {
            _token:"{{ csrf_token() }}",
            pageData,
        },
        success: function(data) {
            if (data) {
                var url = new URL(window.location.href);
                url.searchParams.set('pageData', pageData);
                window.location.href = url.href;
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error(errorThrown);
        }
    });
}
</script>
