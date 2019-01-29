@extends('layouts.app')

@section('content')
<script src="{{url('assets/js/vue.js')}}"></script>
<script src="{{url('assets/js/vue-resource.js')}}"></script>
<script src="{{url('assets/js/axios.js')}}"></script>
<script src="{{url('assets/js/sweetalert2.all.min.js')}}"></script>
<!-- jQuery  -->
<script src="{{url('/assets/js/jquery.min.js')}}"></script>
<script src="{{url('/assets/js/bootstrap.min.js')}}"></script>
<!-- App js -->
<script src="{{asset('assets/js/jquery.core.js')}}"></script>
<script src="{{asset('assets/js/jquery.app.js')}}"></script>
<div class='content col-lg-8'>
    <div class='row' style="padding-bottom: 50px">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <h4 class="pull-left">Search PDF Files:</h4>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5">
            <input type="text" v-bind:value="file_name" v-model="file_name" name="file_name" class="form-control">
       </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <button @click="getFiles">Submit</button>
        </div>
    </div>
    <div class="row col-lg-12 col-md-12 pb-2">
            @{{message}}
        <table class="table table-stripe"> 
            <tr>
                <td>File name</td>
                <td>Path</td>
                <td>Action</td>
            </tr>
            <tr v-for="file in files" v-if="file.file_name">
                <td>@{{file.file_name}}</td>
                <td>@{{file.path}}</td>
                <td>
                    <a :href="file.path" target="_blank">
                        <button>Preview</button>
                    </a>
                    <button @click="sendEmail(file)">Send to E-mail</button>
                    <button>Send to Google Drive (not working yet.)</button>
                    <i class="fa fa-upload"></i>
                </td>
            </tr>
        </table>
    </div>
</div>
<script>

    new Vue({
    el: '.content',
    data: {
        file_name: '',
        message: '',
        files: []
    },
    components: {
    },
    methods: {
        selectedAccess(selectedCheckBox) {
            alert(selectedCheckBox)
        },
        getFiles() {
            axios.get("{{route('api.files')}}"+"?file_name="+this.file_name)
            .then((response) => {
                console.log(response)
                this.files = response.data;
                this.message = response.data.message;
            });
        },
        sendEmail(file) {
            axios.get("{{route('api.send-mail')}}"+"?path="+file.path)
            .then((response) => {
                console.log(response)
            });
        }
    },
    computed: {
       
    },
        mounted() {
          this.getFiles();
        }
    })

</script>
@endsection



