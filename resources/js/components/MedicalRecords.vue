<template>
    <div class="container">
        <div class="content">
            <div class="header">
                <h5>Appointments</h5>
            </div>
            <div id="custom-toolbar-appointments">
                <md-button class="md-fab md-mini md-primary white-text green" id="btn_back" @click.prevet="backToPeoplesList"><md-icon>arrow_back</md-icon></md-button>
                <md-button class="md-fab md-mini md-primary white-text green" id="btn_create" @click.prevent="showModalCreate=true"><md-icon>add</md-icon></md-button>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Date Appointment</th>
                    <th>Notes</th>
                    <th>Cancel</th>
                </tr>
                </thead>
                <tbody>
                <tr class="" v-if="medicalRecordsData.length === 0">
                    <td class="lead text-center">No appointments found</td>
                </tr>
                <tr v-for="(data, key1) in medicalRecordsData" :key="data.id" class="m-datatable__row" v-else>
                    <td>{{data.date_appointment}}</td>
                    <td>{{data.notes}}</td>
                    <td>
                        <md-button class="md-fab md-mini md-primary white-text red" @click.prevent="updateStatusAppointment(data.id)">
                            <md-icon>cancel</md-icon>
                        </md-button>
                    </td>
                </tr>
                </tbody>
            </table>
            <modal-create v-if="showModalCreate" @close.prevent="showModalCreate=false">
                <h5 slot="header">Create Appointment for {{patientName}}</h5>
                <div slot="body">
                    <div class="row">
                        <div class="col s4">
                            <div class="form-group">
                                <label for="formDataAppointment">Date:</label>
                                <input type="hidden" disabled class="form-control" id="formPatientId" name="formPatientId"
                                       required v-model="newMedicalData.people_id">
                                <input type="hidden" disabled class="form-control" id="formStatus" name="formStatus"
                                       required v-model="newMedicalData.status" value="O">

                                <input type="text" class="datepicker-table" id="formDataAppointment" name="formDataAppointment"
                                       required v-model="newMedicalData.date_appointment" placeholder=" Data Appointment">
                            </div>
                        </div>
                        <div class="col s4">
                            <div class="form-group">
                                <label for="formNotes">Name:</label>
                                <input type="text" class="form-control" id="formNotes" name="formNotes"
                                       required v-model="newMedicalData.notes" placeholder="Notes">
                            </div>
                        </div>
                    </div>
                </div>
                <div slot="footer">
                    <button class="btn btn-default" @click.prevent=" showModalCreate=false">
                        Cancel
                    </button>
                    <button class="btn btn-primary" @click.prevent="createMedicalRecord()" id="btnCreatePatient" name="btnCreatePatient">
                        Create
                    </button>
                </div>
            </modal-create>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MedicalRecords",
        props: ['patientId', 'patientName'],
        data() {
            return {
                medicalRecordsData: [],
                e_date: '',
                e_notes: '',
                newMedicalData: { 'people_id': '','date_appointment': '','notes': '','status': ''},
                showModalCreate: false,
                fetchUrl: '',
            }
        },
        created() {
            this.fetchUrl = '/medicalrecords';
            return this.fetchMedicalRecords(this.fetchUrl,this.patientId)
        },
        methods:{
            backToPeoplesList(){
                this.$router.go(0);
            },
            fetchMedicalRecords(url, patientId) {
                axios.get(url+'/'+patientId)
                    .then(data => {
                        this.medicalRecordsData = data.data.data
                    })
            },
            createMedicalRecord: function createMedicalRecord() {
                const _this = this;
                const input = this.newMedicalData;
                input['people_id'] = this.patientId;
                input['status'] = 'O';
                let errors = this.validateAppointment(input);
                if (errors.length > 0){
                    let msgErr = "";
                    errors.forEach(function (item) {
                        msgErr = msgErr + item + "\n";
                    });
                    alert(msgErr);
                }
                else {
                    axios.post('/Medrecords', input).then(function (response) {
                        _this.newMedicalData = { 'people_id': '', 'date_appointment': '', 'notes': '', 'status': ''};
                    });
                    this.showModalCreate = false;
                    this.fetchMedicalRecords(this.fetchUrl, this.patientId);
                }
            },
            isValidDate: function isValidDate(s) {
                let bits = s.split('/');
                let d = new Date(bits[2] + '/' + bits[1] + '/' + bits[0]);
                return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
            },
            validateAppointment: function (input){
                const erros = [];
                const dateIsValid = this.isValidDate(input['date_appointment']);
                if (input['notes'] === ''){
                    erros.push("Invalid Notes!");
                }
                if (input['date_appointment'] === '' || !dateIsValid){
                    erros.push("Invalid appointment date!");
                }
                return erros;
            },
            updateStatusAppointment: function(medicalRecordsID){
                axios.get('/Medrecords.cancel/' + medicalRecordsID + '/C');
                this.fetchMedicalRecords("/medicalrecords", this.patientId);

            }
        }
    }
</script>

<style scoped>

</style>
