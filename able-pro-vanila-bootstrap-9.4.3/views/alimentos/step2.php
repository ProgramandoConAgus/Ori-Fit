                      <div class="tab-pane" id="jobDetail">
                          <div class="text-center">
                            <h3 class="mb-2">Alimentación</h3>
                            <small class="text-muted">Estas preguntas nos ayudarán a entender tus hábitos alimenticios y a personalizar tus planes según tus necesidades.</small>
                          </div>
                          
                          <div class="row mt-4">
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">¿Cuántas comidas al día quieres hacer?</label>
                                <select name="comidas[]" class="form-select select2-multiple" multiple="multiple" required >
                                      <option value="desayuno">Desayuno</option>
                                      <option value="almuerzo">Almuerzo</option>
                                      <option value="merienda">Merienda</option>
                                      <option value="cena">Cena</option>
                                      <option value="snack">Snack</option>
                                      </select>
                              </div>
                            </div>
                            <div class="col-sm-6">
    <div class="mb-3">
        <label class="form-label  mb-2">¿Hay algún alimento que no te guste o seas alérgico?</label>
        <select name="alimentos_excluidos[]" 
                id="alergias-input" 
                class="form-select select2-multiple"
                multiple 
                data-placeholder="Selecciona alimentos">
            <?php
            $consulta = "SELECT * FROM ingredientes ORDER BY Nombre";
            $stm = $conexion->prepare($consulta);
            $stm->execute();
            $resultado = $stm->get_result();
            
            if ($resultado->num_rows > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $fila['IdIngrediente'] . "'>" . htmlspecialchars($fila['Nombre']) . "</option>";
                }
            } else {
                echo "<option value='' disabled>No hay ingredientes disponibles</option>";
            }
            ?>
        </select>
    </div>
</div>
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label"> ¿Tienes alguna enfermedad o patología alimenticia?</label>
                                <input type="text" name="enfermedades" class="form-control" placeholder="" required />
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">¿Cómo te sientes cuando comes?</label>
                                <input type="text" name="sentimientos_alimentacion" class="form-control" placeholder="" required />
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3">
                                <label class="form-label">Si tuvieses una situación de estrés/angustia. ¿Qué te ayuda a salir de eso?</label>
                                <input type="text" name="estres_soluciones" class="form-control" placeholder="" required />
                              </div>
                            </div>
                          </div>
                      </div>
                      <!-- end job detail tab pane -->
                      <div class="tab-pane" id="educationDetail">
    <div class="text-center">
        <h3 class="mb-2">Actividad Física</h3>
        <small class="text-muted">La información sobre tu rutina de ejercicio es esencial para adaptar tu plan a tu actividad física habitual.</small>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label" for="actividadtrabajo">¿Tu trabajo es sedentario o activo?</label>
                <select name="trabajo" class="form-control" required>
                    <option value="default" disabled selected>Seleccionar</option>
                    <option value="sedentario">Sedentario</option>
                    <option value="activo">Activo</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label" for="ejercicio">¿Haces o empezarás a hacer ejercicio físico?</label>
                <select name="ejercicio" id="ejercicio" class="form-control" required>
                    <option value="default" disabled selected>Seleccionar</option>
                    <option value="si">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>

        <!-- Campos adicionales ocultos inicialmente -->
        <div id="extraFields" style="display: none; gap: 20px; margin-top: 10px;">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="diasEntrenamiento">Días de entrenamiento (1-7)</label>
                    <input name="dias_entrenamiento" type="number" id="diasEntrenamiento" class="form-control" min="1" max="7" placeholder="Días de entrenamiento" required />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="intensidad">Intensidad (1-6)</label>
                    <input name="intensidad" type="number" id="intensidad" class="form-control" min="1" max="6" placeholder="Intensidad" required />
                </div>
            </div>
        </div>

        <?php if ($datosUsuario['idTipoPlan'] == 3): ?>
            <!-- Campos adicionales para idTipoPlan 3 -->
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="actividad_previas">¿Ya realizaste actividad física en otro momento? ¿Cuál?</label>
                    <input type="text" name="actividad_previas" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="lesiones">¿Tenés o tuviste alguna lesión?</label>
                    <input type="text" name="lesiones" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="ultimo_entrenamiento">Si no te encuentras entrenando actualmente, ¿Cuándo fue la última vez que lo hiciste?</label>
                    <input type="text" name="ultimo_entrenamiento" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="dias_disponibles">¿De cuántos días de la semana dispones para entrenar? (3, 4 o 5)</label>
                    <input type="number" name="dias_disponibles" class="form-control" min="3" max="5" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="lugar_entrenamiento">La rutina de entrenamiento ¿la realizarás en un gimnasio o en tu casa?</label>
                    <select name="lugar_entrenamiento" class="form-control" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="gimnasio">Gimnasio</option>
                        <option value="casa">Casa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="preferencia_ejercicios">Te gustan los ejercicios con elementos/máquinas o sin elementos:</label>
                    <select name="preferencia_ejercicios" class="form-control" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="con elementos">Con elementos/máquinas</option>
                        <option value="sin elementos">Sin elementos</option>
                    </select>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
                      <!-- end education detail tab pane -->
                      <div class="tab-pane" id="finish">
                        <div class="row d-flex justify-content-center">
                          <div class="col-lg-6">
                            <div class="text-center">
                              <i class="ph-duotone ph-gift f-50 text-danger"></i>
                              <h3 class="mt-4 mb-3">Muy bien !</h3>
                              <div class="mb-3">
                                <div class="form-check d-inline-block">
                                  <label class="form-check-label" for="customCheck1">Recibiras un email en las próximas 72 hs con tu plan personalizado</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end col -->
                        </div>
                        <!-- end row -->
                      </div>
                      <!-- END: Define your tab pans here -->
                      <!-- START: Define your controller buttons here-->
                     <!-- Controles de Navegación -->
                          <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="btnAnterior" style="display: none;">Anterior</button>
                            <button type="button" class="btn btn-primary" id="btnSiguiente">Siguiente</button>
                            <button type="submit" class="btn btn-success" id="btnTerminar" style="display: none;">Terminar</button>
                          </div>
                    </form>
                      <!-- END: Define your controller buttons here-->
                    </div>
                  </div>
                </div>
                <!-- end tab content-->
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col my-1">
            <p class="m-0"
              >PCA - 2024</p
            >
          </div>
         
        </div>
      </div>
    </footer>

    <!-- Botón flotante de ayuda -->
<button type="button" 
        class="btn btn-primary rounded-circle shadow-lg p-0"
        style="
            position: fixed; 
            bottom: 30px; 
            right: 30px; 
            z-index: 1000;
            width: 58px;
            height: 58px;
        " 
        data-bs-toggle="modal" 
        data-bs-target="#helpModal">
    <i class="ph-duotone ph-question" style="font-size: 2rem"></i>  <!-- Ícono agrandado -->
</button>
<!-- Modal de ayuda -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">¿Necesitas ayuda?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="helpForm">
                    <div class="mb-3">
                        <label class="form-label">¡Envíanos tu consulta!</label>
                        <textarea 
                            name="mensaje" 
                            class="form-control" 
                            rows="4" 
                            placeholder="Describe tu problema o duda..."
                            required
                            maxlength="500"
                        ></textarea>
                        <small class="text-muted">Máximo 500 caracteres</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Enviar consulta
                    </button>
                </form>
          </div>
        </div>
    </div>
</div>
<script src="js/alimentosForm.js"></script>
</body>
<!-- [Body] end -->
</html>
