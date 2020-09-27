<template>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="row col-8">
                <div class="col-6 titulo">
                    <h2>Pagar ahora</h2>
                </div>
                <div class="w-100"></div>
                <div class="col-6 informacion">
                    <b>Concepto del pago: <span> {{ info.concepto }} </span></b>
                    <b>Tipo de bien: <span> {{ info.tipo_bien }} </span></b>
                    <b>ID del evento: <span> {{ info.id_evento }} </span></b>
                    <b>Importe del servicio: <span> {{ info.importe }} </span></b>
                </div>

                <div class="col-6 informacion">
                    <b>Fecha de adjudición: <span> {{ info.fecha }} </span></b>
                    <b>Hora de adjudición: <span> {{ info.hora }} </span></b>
                </div>

                <div class="col-12" v-if="ver_datos">

                    <form>
                        <div class="row">
                            <div class="col-6">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="name" id="_name" v-model="tokenParams.card.name">
                            </div>
                            <div class="col-6">
                                <label>Numero de tarjeta de crédito</label>
                                <input type="text" class="form-control" name="number" id="_number" v-model="tokenParams.card.number">
                            </div>

                            <div class="col-6 expiracion">
                                <label>Fecha de expiración (MM/AAAA)</label>
                                <br>
                                <input type="text" class="form-control" name="name" id="_name" v-model="tokenParams.card.exp_year">
                                /
                                <input type="text" class="form-control" name="name" id="_name" v-model="tokenParams.card.exp_month">
                            </div>
                            <div class="col-6 expiracion">
                                <label>CVC</label>
                                <br>
                                <input type="text" class="form-control" name="number" id="_number" v-model="tokenParams.card.cvc">
                            </div>
                            <div class="col-6">
                                <label>Numero Telefonico</label>
                                <input type="text" class="form-control" name="number" id="_number" v-model="info.number_phone">
                            </div>
                            <div class="col-12 mt-4">
                                <input class="btn btn-primary" @click="realizarPago" value="Pagar" type="button">
                               
                            </div>
                        </div>
                    </form>
                    
                </div>
                <input class="btn btn-primary" v-if="!ver_datos" @click="generar" value="Generar Comprobante" type="button">
                   
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                tokenParams : {
                    card: {
                        number: "",
                        name: "",
                        exp_year: "",
                        exp_month: "",
                        cvc: "",
                    },
                },
                info: {
                    concepto: "Realizando un evento de subasta",
                    tipo_bien: "Correo",
                    id_evento: "MXN371599664762",
                    importe: 15,
                    fecha: "fecha",
                    hora: "hora",
                    number_phone: "",
                    token: "",
                    
                },
                url: `${window.location.href}`,
                ver_datos: true,
                

            }
        },
        methods: {

            successResponseHandler : function(token) {
                this.info.token = token.id;
            },
            errorResponseHandler : function(error) {

                //coloque el codigo simulando que esta sea la respuesta corecta apesar de que sea un error
                //pues al no tener las llaves, esta es la funcion que se ejecuta

                axios.post( `${this.url}realizar-pago`,
                    { datos_tarjeta: this.tokenParams, datos_info: this.info })
                    .then(response => {
                            
                        this.ver_datos = false;
                        alert("Pago realizado de forma correcta");
                            
                    })
                    .catch(error => {
                        alert(error.message);
                });
            },

            realizarPago()
            {
                Conekta.setPublicKey("key_eYvWV7gUaMyaN4iD");
                Conekta.Token.create(this.tokenParams, this.successResponseHandler, this.errorResponseHandler);
            },

            generar()
            {
                axios.post( `${this.url}generar-comprobante`)
                    .then(response => {
                            
                        alert("Comporbante Generado");
                        location.reload();
                            
                    })
                    .catch(error => {

                        alert(error.message);
                });
            }

            
        },
        mounted(){
            
        }
    }
</script>

