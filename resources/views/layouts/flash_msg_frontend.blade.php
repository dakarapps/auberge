@if(session('success'))
    <div id="snackbar">{{session('success')}}</div>
    <script>showSnackbar();</script>
@elseif(session('error'))
    <div id="snackbar">{{session('error')}}</div>
    <script>showSnackbar();</script>
@elseif(session('error'))
    <div id="snackbar">{{session('error')}}</div>
    <script>showSnackbar();</script>
@endif
