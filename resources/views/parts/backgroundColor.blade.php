<style>
    .color-box {

        display: inline;
        margin-right: 10px;
        border: 1px solid black;
        padding: 20px
    }
</style>
<div class="modal fade" id="modal-color">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h4 class="modal-title">COLORS </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                        <div class="row d-block">
                            <h4 class="">Navbar and Sidebar Colors</h4>
                            <div class="sidebarAndNavbarColor"></div>
                            <h4 class="">Card Colors</h4>
                            <div class="cardColor"></div>
                        </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.addEventListener('load', function() {
        const SlidebarNavbarBackgroundcolors = [
        'rgb(6, 0, 85)','rgb(85, 0, 0)','rgb(0, 61, 0)','rgb(0, 0, 0)','rgb(107, 107, 0)'
      ];
      let element = "";
      for (let i = 0; i < SlidebarNavbarBackgroundcolors.length; i++) {
        element += `<div class="color-box d-inline-block"
                         style="background-color: ${SlidebarNavbarBackgroundcolors[i]};"
                         onclick="setColorAndApply('${SlidebarNavbarBackgroundcolors[i]}')">
                    </div>`;
      }
      let sidebarAndNavbarColor = selector('.sidebarAndNavbarColor');
      sidebarAndNavbarColor.innerHTML = element;
      const CardColors = [
        'white','rgb(85, 0, 0)','rgb(0, 61, 0)','rgb(0, 0, 0)','rgb(107, 107, 0)'
      ];
       element = "";
      for (let i = 0; i < CardColors.length; i++) {
        element += `<div class="color-box d-inline-block" style="background-color: ${CardColors[i]};" onclick="SetCardColor('${CardColors[i]}')"></div>`;
      }
      let cardColor = selector('.cardColor');
      cardColor.innerHTML = element;
    });

      function setColorAndApply(color) {
            localStorage.setItem('sidebar_navbar_background_color', color);
            applyColorToTarget(color);
        }
      function SetCardColor(color) {
            localStorage.setItem('card_background_color', color);
            forAllSameClass('.card');
        }
        function applyColorToTarget(color) {
            var element1 = selector('.sidebar-dark-primary');
            var element2 = selector('.nav-dev');
            var element3 = selector('.bottombar');
            element1.style.backgroundColor = localStorage.getItem('sidebar_navbar_background_color');
            element2.style.backgroundColor = localStorage.getItem('sidebar_navbar_background_color');
            element3.style.backgroundColor = localStorage.getItem('sidebar_navbar_background_color');
        }
</script>
