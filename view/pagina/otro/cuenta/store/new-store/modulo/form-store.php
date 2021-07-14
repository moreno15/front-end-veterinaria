<div class="tab-pane transition  fade scale" id="createStore" role="tabpanel">

   	<!-- Modal Header -->
      <div class="modal-header" style="color:#FFFFFF">
          <h4 class="modal-title text-center">2. Informacion de la empresa</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body mt-10">

      	<!--=====================================
          Nombre de la tienda
          ======================================-->

          <div class="form-group">

          	<label>Nombre Comercial<sup class="text-danger">*</sup></label>

          	<div class="form-group__content">

          		<input
          		type="text"
          		class="form-control formStore"
          		name="nameStore"
          		pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
          		onchange="validateDataRepeat(event, 'store')"
          		required>
          		<div class="valid-feedback">Valid.</div>
          		<div class="invalid-feedback">Please fill out this field.</div>
          	</div>

          </div>
          <!--=====================================
          Url de la tienda
          ======================================-->

          <div class="form-group">

              <label>Store Url<sup class="text-danger">*</sup></label>

              <div class="form-group__content">

                <input
                type="text"
                  class="form-control formStore"
                  name="urlStore"
                  readonly
                  required>

                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>

              </div>

          </div>
          <!--=====================================
            razon social de la tienda
            ======================================-->

            <div class="form-group">

              <label>Razon Social<sup class="text-danger">*</sup></label>

              <div class="form-group__content">

                <input
                type="text"
                class="form-control formStore"
                name="razonSocialStore"
                pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                onchange="validateDataRepeat(event, 'storeRazon')"
                required>

                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>

              </div>

            </div>
            <!--=====================================
                RUC DE LA TIENDS
                  ======================================-->
          <div class="form-group">

                      <label>RUC<sup class="text-danger">*</sup></label>

                      <div class="form-group__content input-group">

                          <input
                          name="rucStore"
                          class="form-control formStore"
                          type="text"
                          pattern="[-\\(\\)\\0-9 ]{1,}"
                          onchange="validateJS(event, 'ruc')"
                          required  maxlength="12" size="12">

                          <div class="valid-feedback">Valid.</div>
                          <div class="invalid-feedback">Please fill in this field correctly.</div>

                      </div>

                  </div>
          <!--=====================================
          Email de la tienda
          ======================================-->

          <div class="form-group">

              <label>Store Email<sup class="text-danger">*</sup></label>

              <div class="form-group__content">

                  <input type="email"
                  class="form-control formStore"
                  name="emailStore"
                  class="form-control"
                  value="<?php echo $_SESSION["user"]->email_user ?>"
                  readonly
                  required>

                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>

              </div>

          </div>

     <!--=====================================
  		Pais de la tienda
  		======================================-->

          <div class="form-group">

              <label>Departamento<sup class="text-danger">*</sup></label>

              <?php

                $data = file_get_contents("view/json/ubigeo.json");
                $ubigeo = json_decode($data, true);
                $coddep=explode("-",$_SESSION["user"]->department_user)[0];
                $codpro=explode("-",$_SESSION["user"]->province_user)[0];
                $coddis=explode("-",$_SESSION["user"]->district_user)[0];
              ?>

              <div class="form-group__content">

                <select
                name="departmentStore"
                id="departmentOrder"
                class="form-control    formStore"
                onchange="provincia()"
                required>

                  <option value >Departamento</option>
                <?php foreach ($ubigeo as $key => $value): ?>

                  <?php if ($value["codi_pro"]==0&&$value["codi_dis"]==0): ?>
                          <option value="<?php echo $value["codi_dep"].'-'.$value["description"] ?>"><?php echo $value["description"] ?></option>
                  <?php endif; ?>
                <?php endforeach ?>

                </select>


                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill in this field correctly.</div>

              </div>

          </div>

           <!--=====================================
  		Ciudad del usuario
  		======================================-->

          <div class="form-group">

              <label>Provincia<sup class="text-danger">*</sup></label>

              <div class="form-group__content">
                <select name="provinceStore"
                id="provinceOrder"
                class="form-control  formStore"
                onchange="distrito()" required
                 >
                <option  >-</option>
                </select>

                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill in this field correctly.</div>

              </div>

          </div>
          <!--=====================================
     Ciudad del usuario
     ======================================-->

         <div class="form-group">

             <label>Distrito<sup class="text-danger">*</sup></label>

             <div class="form-group__content">
               <select
                name="districtStore"
                id="districtOrder"
                class="form-control formStore " required
                 >
                <option  >-</option>
                </select>

                 <div class="valid-feedback">Valid.</div>
                 <div class="invalid-feedback">Please fill in this field correctly.</div>

             </div>

         </div>

          <!--=====================================
  		Teléfono del usuario
  		======================================-->

      <div class="form-group">

              <label>Store Phone<sup class="text-danger">*</sup></label>

              <div class="form-group__content input-group">

                  <input
                  name="phoneStore"
                  class="form-control formStore"
                  type="text"
                  pattern="[-\\(\\)\\0-9 ]{1,}"
                  onchange="validateJS(event, 'phone')"
                  value="<?php echo $_SESSION["user"]->phone_user ?>"
                  required>

                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill in this field correctly.</div>

              </div>

          </div>

          <!--=====================================
  		Dirección del usuario
  		======================================-->

        <div class="form-group">

                  <label>Direccion<sup class="text-danger">*</sup></label>

                  <div class="form-group__content">

                      <input
                      name="addressStore"
                      class="form-control formStore"
                      type="text"
                      pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                      onchange="validateJS(event, 'paragraphs')"
                      value="<?php echo $_SESSION["user"]->address_user ?>"
                      required>

                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill in this field correctly.</div>

                  </div>

              </div>


     <h3>3. Datos Bancarios</h3>

      <!--=====================================
        titulatar cuanta bancaria
        ======================================-->

       <div class="form-group">
                 <label>Titular<sup class="text-danger">*</sup></label>
                 <div class="form-group__content input-group">
                     <input
                     name="titularStore"
                     class="form-control formStore"
                     type="text"
                     pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                     onchange="validateJS(event, 'text')"
                     required>
                     <div class="valid-feedback">Valid.</div>
                     <div class="invalid-feedback">Please fill in this field correctly.</div>
                 </div>
        </div>
             <!--=====================================
                 RUC DE LA TIENDS
                   ======================================-->
        <div class="form-group">

                       <label>DNI<sup class="text-danger">*</sup></label>

                       <div class="form-group__content input-group">

                           <input
                           name="dniStore"
                           class="form-control formStore"
                           type="text"
                           pattern="[-\\(\\)\\0-9 ]{1,}"
                           onchange="validateJS(event, 'dni')"
                           required  maxlength="8" size="8">

                           <div class="valid-feedback">Valid.</div>
                           <div class="invalid-feedback">Please fill in this field correctly.</div>

                       </div>

                   </div>
             <!--=====================================
            titulatar cuanta bancaria
            ======================================-->

      <div class="form-group">

                 <label>N° Cuenta(soles)<sup class="text-danger">*</sup></label>

                 <div class="form-group__content input-group">

                     <input
                     name="numCuentaBanca"
                     class="form-control formStore"
                     type="text"
                     pattern="[-\\(\\)\\0-9 ]{1,}"
                     onchange="validateJS(event, 'number')"
                     required>

                     <div class="valid-feedback">Valid.</div>
                     <div class="invalid-feedback">Please fill in this field correctly.</div>

                 </div>

             </div>
             <!--=====================================
        titulatar cuanta bancaria
        ======================================-->

      <div class="form-group">

                 <label>N° Cuenta Interbancaria<sup class="text-danger">*</sup></label>

                 <div class="form-group__content input-group">

                     <input
                     name="cuentaInteri"
                     class="form-control formStore"
                     type="text"
                     pattern="[-\\(\\)\\0-9 ]{1,}"
                     onchange="validateJS(event, 'number')"
                     required>

                     <div class="valid-feedback">Valid.</div>
                     <div class="invalid-feedback">Please fill in this field correctly.</div>

                 </div>

        </div>
             <!--=====================================
            titulatar cuanta bancaria
            ======================================-->

       <div class="form-group">

                 <label>Tipo de cuenta<sup class="text-danger">*</sup></label>

                 <div class="form-group__content input-group">

                   <input
                   name="tipoCuenta"
                   class="form-control formStore"
                   type="text"
                   pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                   onchange="validateJS(event, 'text')"
                   required>

                     <div class="valid-feedback">Valid.</div>
                     <div class="invalid-feedback">Please fill in this field correctly.</div>

                 </div>

             </div>
             <!--=====================================
            titulatar cuanta bancaria
            ======================================-->

       <div class="form-group">

                 <label>Banco<sup class="text-danger">*</sup></label>

                 <div class="form-group__content input-group">

                   <select class=" form-control formStore" name="banco" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" required>
                     <option value="">Seleccione</option>
                     <option value="BANCO AZTECA">BANCO AZTECA</option>
                     <option value="BANCO CENCOSUD">BANCO CENCOSUD</option>
                     <option value="BANCO DE COMERCIO">BANCO DE COMERCIO</option>
                     <option value="BANCO DE CREDITO DEL PERU">BANCO DE CRÉDITO DEL PERÚ</option>
                     <option value="BANCO FALABELLA">BANCO FALABELLA</option>
                     <option value="BANCO GNB PERU">BANCO GNB PERÚ</option>
                     <option value="BANCO INTERAMERICANO DE FINANZAS (BANBIF)">BANCO INTERAMERICANO DE FINANZAS (BANBIF)</option>
                     <option value="BANCO PICHINCHA">BANCO PICHINCHA</option>
                     <option value="BANCO RIPLEY">BANCO RIPLEY</option>
                     <option value="BANCO SANTANDER PERU">BANCO SANTANDER PERÚ</option>
                     <option value="BBVA CONTINENTAL">BBVA CONTINENTAL</option>
                     <option value="CITIBANK PERU">CITIBANK PERÚ</option>
                     <option value="ICBC PERU BANK">ICBC PERU BANK</option>
                     <option value="INTERBANK">INTERBANK</option>
                     <option value="MIBANCO">MIBANCO</option>
                     <option value="SCOTIABANK PERU">SCOTIABANK PERÚ</option>
                   </select>

                     <div class="valid-feedback">Valid.</div>
                     <div class="invalid-feedback">Please fill in this field correctly.</div>

                 </div>

             </div>
             <h3>4. Documentos Adjuntos(Formato PDF)</h3>

             <div class="form-group">
                       <label>Documento bancario<sup class="text-danger">*</sup></label>

                       <div class="form-group__content">
                         <div class="custom-file">

                           <input
                           type="file"
                           id="fichaBancaStore"
                           class="custom-file-input formStore"
                           name="fichaBancaStore"
                           accept="application/pdf"
                           maxSize="2000000"
                           onchange="validateAdjuntJS(event, 'changeBancaStore')"
                           required>
                           <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                                 <label class="custom-file-label" id="changeBancaStore" for="coverStore"> </label>
                         </div>
                       </div>
              </div>



                     <!--=====================================
                     documentos adjuntos
                     ======================================-->
                  <div class="form-group">
                        <label>Ficha RUC completa<sup class="text-danger">*</sup></label>
                        <div class="form-group__content">
                            <div class="custom-file">
                                 <input
                                       type="file"
                                       id="fichaRucStore"
                                       class="custom-file-input formStore"
                                       name="fichaRucStore"
                                       accept="application/pdf"
                                       maxSize="2000000"
                                       onchange="validateAdjuntJS(event, 'changeRucStore')"
                                       required>

                                  <div class="valid-feedback">Valid.</div>
                                   <div class="invalid-feedback">Please fill out this field.</div>
                                   <label class="custom-file-label" id="changeRucStore" for="coverStore"> </label>

                              </div>
                         </div>
                  </div>

                  <div class="form-group">

                        <label>DNI vigente del representante legal<sup class="text-danger">*</sup></label>

                        <div class="form-group__content">
                              <div class="custom-file">
                                <input
                                        type="file"
                                        id="fichaDNIStore"
                                        class="custom-file-input formStore"
                                        name="fichaDNIStore"
                                        accept="application/pdf"
                                        maxSize="2000000"
                                        onchange="validateAdjuntJS(event, 'changeDniStore')"
                                        required>

                                  <div class="valid-feedback">Valid.</div>
                                  <div class="invalid-feedback">Please fill out this field.</div>
                                  <label class="custom-file-label" id="changeDniStore" for="coverStore"> </label>
                              </div>
                        </div>
                    </div>
           </div>


      <!-- Modal footer -->
    <!--  <div class="modal-footer">

      	<button type="button" class="btn btn-primary " onclick="validateFormStore()">Siguiente</button>

      </div>-->

      <!-- Modal footer -->
    <div class="modal-footer">

          <div class="form-group submtit">

              <button
              type="submit"
              class="btn btn-outline-primary   " onclick="validateFormStore()"> <span class="fa fa-floppy-o"></span> Rigistrar</button>

              <?php

                  $newVendor = new VendorsController();
                  $newVendor -> newVendor();
              ?>


          </div>


      </div>


</div>
