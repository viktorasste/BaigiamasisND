
//# sourceMappingURL=/sm/f07d8d7b2652873f485707eab4f3d300bf1f6f3b42912e189c8933b1b9b3dfde.map

$( document ).ready(function() {
    setTimeout(function(){
        $('input[name="dates"]').daterangepicker({
            dateFormat: 'yy-mm-dd'
            , isInvalidDate: function(ele) {
                var currDate = moment(ele._d).format('YY-MM-DD');
                return ["23-02-14"].indexOf(currDate) != -1;
            }
            , locale: {
                format: 'YYYY-MM-DD'
            }
        });
    }, 200 )
});
