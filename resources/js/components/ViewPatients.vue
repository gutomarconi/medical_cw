<template>
    <div class="container">
        <div class="content" v-if="!showMedicalRecords">
            <h4>List of Patients</h4>

            <md-button class="md-fab md-primary white-text green" id="btn_createPatient" @click.prevent="showModalCreate=true">
                <md-icon>add</md-icon>
            </md-button>
            <div class="data-table">
                <table class="table flex-column">
                    <thead>
                    <tr>
                        <th v-for="column in columns" :key="column"
                            class="table-head">
                            {{ column | columnHead }}
                        </th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="" v-if="patientsData.length === 0">
                        <td class="lead text-center" :colspan="columns.length + 1">No data found.</td>
                    </tr>
                    <tr v-for="(data, key1) in patientsData" :key="data.id" class="m-datatable__row" v-else>
                        <td @click.prevent="showMedRecords(data.id, data.name);">{{data.name}}</td>
                        <td>{{data.email}}</td>
                        <td>{{data.date_of_birth}}</td>
                        <td>{{data.phone_number}}</td>
                        <td>{{data.height}}</td>
                        <td>{{data.weight}}</td>
                        <td>
                            <div class="btn-group">
                                <md-button class="md-fab md-mini md-primary white-text green" @click.prevent="showModal=true;
                                    setPatient(data.id, data.name, data.email, data.date_of_birth, data.phone_number, data.height, data.weight)">
                                    <md-icon>edit</md-icon>
                                </md-button>
                                <md-button class="md-fab md-mini md-primary white-text red" @click="deletePatient(data)">
                                    <md-icon>delete</md-icon>
                                </md-button></div>
                        </td>

                    </tr>
                    </tbody>
                </table>
                <modal-create v-if="showModalCreate" @close.prevent="showModalCreate=false">
                    <h3 slot="header">Create Patient</h3>
                    <div slot="body">
                        <div class="row">
                            <div class="col s4">
                                <div class="form-group">
                                    <label for="formName">Name:</label>
                                    <input type="text" class="form-control" id="formName" name="formName"
                                           required v-model="newPatientsData.name" placeholder=" Full name">
                                </div>
                            </div>
                            <div class="col s4">
                                <div class="form-group">
                                    <label for="email">Name:</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           required v-model="newPatientsData.email" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s4">
                                <div class="form-group">
                                    <label for="dateofbirth">Date of birth:</label>
                                    <input type="text" class="datepicker-table" id="dateofbirth" name="dateofbirth"
                                           required  v-model="newPatientsData.date_of_birth" placeholder=" Date of Birth">
                                </div>
                            </div>
                            <div class="col s4">
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number:</label>
                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                           required v-model="newPatientsData.phone_number" placeholder=" Phone Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s4">
                                <div class="form-group">
                                    <label for="height">Height:</label>
                                    <input type="number" class="form-control" id="height" name="height"
                                           required v-model="newPatientsData.height" placeholder=" Height">
                                </div>
                            </div>
                            <div class="col s4">
                                <div class="form-group">
                                    <label for="weight">Weight</label>
                                    <input type="number" class="form-control" id="weight" name="weight"
                                           required v-model="newPatientsData.weight" placeholder=" Weight">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div slot="footer">
                        <button class="btn btn-default" @click.prevent=" showModalCreate=false">
                            Cancel
                        </button>
                        <button class="btn btn-primary" @click.prevent="createPatient()" id="btnCreatePatient" name="btnCreatePatient">
                            Create
                        </button>
                    </div>
                </modal-create>
                <modal v-if="showModal" @close.prevent="showModal=false">
                    <h3 slot="header">Edit Patient</h3>
                    <div slot="body">

                        <div class="row">
                            <div class="col s4">
                                <input type="hidden" disabled class="form-control" id="e_id" name="id"
                                       required  :value="this.e_id">
                                Name: <input type="text" class="form-control" id="e_name" name="name"
                                             required  :value="this.e_name">
                            </div>
                            <div class="col s4">
                                Email: <input type="text" class="form-control" id="e_email" name="email"
                                            required  :value="this.e_email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s4">
                                Date of Birth: <input type="text" class="datepicker-table" id="e_dateofbirth" name="dateofbirth"
                                                   required  :value="this.e_dateofbirth">
                            </div>
                            <div class="col s4">
                                Phone Number: <input type="text" class="form-control" id="e_phonenumber" name="phonenumber"
                                                      required  :value="this.e_phonenumber">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s4">
                                Height: <input type="number" class="form-control" id="e_height" name="height"
                                                      required  :value="this.e_height">
                            </div>
                            <div class="col s4">
                                Weight: <input type="number" class="form-control" id="e_weight" name="weight"
                                                      required  :value="this.e_weight">
                            </div>
                        </div>
                    </div>
                    <div slot="footer">
                        <button class="btn btn-default" @click.prevent=" showModal=false">
                            Cancel
                        </button>
                        <button class="btn btn-info" @click.prevent="editPatient()">
                            Update
                        </button>
                    </div>
                </modal>
            </div>
        </div>
        <medical-records v-bind:patientId=currentPatientID v-bind:patientName=currentPatientName v-else="showMedicalRecords"></medical-records>
    </div>
</template>

<script type="text/ecmascript-6">
    import MedicalRecords from './MedicalRecords';

    export default {
        name: 'ViewPatients',
        components: {MedicalRecords},
        props: {
            fetchUrl: { type: String, required: true },
            columns: { type: Array, required: true },
        },
        data() {
            return {
                patientsData: [],
                e_name: '',
                e_email: '',
                e_dateofbirth: '',
                e_phonenumber: '',
                e_height : 0,
                e_weight : 0,
                currentPatientID: 0,
                currentPatientName: '',
                newPatientsData: { 'name': '','email': '','date_of_birth': '','phone_number': '' ,'height': '','weight': ''},
                showModal: false,
                showModalCreate: false,
                showMedicalRecords: false,
            }
        },
        created() {
            return this.fetchPatients(this.fetchUrl)
        },
        methods: {
            setPatient(val_id, val_name, val_email, val_dateofbirth, val_phonenumber, val_height, val_weight) {
                this.e_id = val_id;
                this.e_name = val_name;
                this.e_email = val_email;
                this.e_dateofbirth = val_dateofbirth;
                this.e_phonenumber = val_phonenumber;
                this.e_height = val_height;
                this.e_weight = val_weight;
            },
            fetchPatients(url) {
                axios.get(url)
                    .then(data => {
                        this.patientsData = data.data.data
                    });
            },
            deletePatient: function (item) {
                axios.get('/validateDelete/'+item.id).then (response => {
                    if (response.data.canDelete == false) {
                        window.alert("Patient have outstanding appointments.");
                    } else {
                        axios.delete('/Peoples/' + item.id).then(function (response) {
                        });
                        this.fetchPatients("/patients");
                    }
                });
            },
            editPatient: function(){
                let id = document.getElementById('e_id');
                let name = document.getElementById('e_name');
                let email = document.getElementById('e_email');
                let dateofbirth = document.getElementById('e_dateofbirth');
                let phonenumber = document.getElementById('e_phonenumber');
                let height = document.getElementById('e_height');
                let weight = document.getElementById('e_weight');

                let input = { 'name': name.value,'email': email.value,'date_of_birth': dateofbirth.value,'phone_number': phonenumber.value ,'height': height.value,'weight': weight.value};
                let msgErr = "";
                let errors = this.validatePatient(input);
                if (errors.length > 0){
                    errors.forEach(function (item) {
                        msgErr = msgErr + item + "\n";
                    });
                    alert(msgErr);
                }
                else {
                    axios.put('/Peoples/' + id.value, {name: name.value, email: email.value,date_of_birth: dateofbirth.value, phone_number: phonenumber.value, height: height.value , weight: weight.value  })
                    this.showModal=false;
                    this.fetchPatients("/patients");
                }
            },
            isValidDate: function isValidDate(s) {
                var bits = s.split('/');
                var d = new Date(bits[2] + '/' + bits[1] + '/' + bits[0]);
                return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
            },
            validatePatient: function (input){
                const erros = [];
                const dateIsValid = this.isValidDate(input['date_of_birth']);
                if (input['name'] === ''){
                    erros.push("Invalid Name!");
                }
                if (input['email'] === '' || input['email'].toLowerCase().indexOf("@") === -1){
                    erros.push("Invalid Email!");
                }
                if (input['phone_number'] === ''){
                    erros.push("Invalid Phone Number!");
                }
                if (input['date_of_birth'] == '' || !dateIsValid){
                    erros.push("Invalid Date of Birth!");
                }
                if (input['height'] == 0){
                    erros.push("Invalid Height!");
                }
                if (input['weight'] == 0){
                    erros.push("Invalid Weight!");
                }
                return erros;

            },
            createPatient: function createPatient() {
                const _this = this;
                const input = this.newPatientsData;
                let errors = this.validatePatient(input);
                if (errors.length > 0){
                    let msgErr = "";
                    errors.forEach(function (item) {
                        msgErr = msgErr + item + "\n";
                    });
                    alert(msgErr);
                }
                else {
                    axios.post('/Peoples', input).then(function (response) {
                        _this.newPatientsData = { 'name': '', 'email': '', 'date_of_birth': '', 'phone_number': '' , 'height': '' , 'weight': ''  };
                    });
                    this.showModalCreate = false;
                    this.fetchPatients("/patients");
                }
            },
            showMedRecords: function showMedRecords(patientId, patientName) {
                this.currentPatientID=patientId;
                this.currentPatientName=patientName;
                this.showMedicalRecords = true;
            }

        },
        filters: {
            columnHead(value) {
                return value.split('_').join(' ').toUpperCase()
            },
        },
    }
</script>

<style scoped>
</style>
