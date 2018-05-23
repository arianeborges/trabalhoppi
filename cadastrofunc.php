<?php include "sidebar.php" ?>

    <div class="container cadastro">
        <div class = "col-sm-offset-1 col-sm-10">
            <h2> CADASTRO DE NOVO FUNCIONARIO </h2>
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#dadospessoais">Dados Pessoais</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#documentos">Documentos</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#endereco">Endereço</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="dadospessoais">
                            <form class="form-horizontal" method="POST">

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="nomefunc">Nome:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nomefunc" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="datanascimentofunc">Data de nascimento:</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" name="datanascimentofunc" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="sexofunc">Sexo:</label>
                                    <input type="radio" name="sexofunc" value="masculino">Masculino</label>
                                    <input type="radio" name="sexofunc" value="feminino">Feminino</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="estadocivil">Estado Civil:</label>
                                    <div class="col-sm-3">
                                        <select name="estadocivil" id="estadocivil" required>
                                            <option value="" selected>Selecione</option>
                                            <option value="solteiro">Solteiro</option>
                                            <option value="casado">Casado</option>
                                            <option value="divorciado">Divorciado</option>
                                            <option value="viuvo">Viuvo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="cargofunc">Cargo:</label>
                                    <div class="col-sm-4">
                                        <select name="cargofunc" id="cargofunc" required>
                                            <option value="" selected>Selecione</option>
                                            <option value="secretario">Secretário</option>
                                            <option value="dentista">Cirurgião Dentista</option>
                                            <option value="faxineiro">Faxineiro</option>
                                            <option value="informatica">Suporte</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="cargodentista">Especialidade médica:</label>
                                    <div class="col-sm-3">
                                        <select name="cargodentista" id="cargodentista" required>
                                            <option value="" selected>Selecione</option>
                                            <option value="cirurgiaodentista">Cirurgião Dentista</option>
                                            <option value="odontopediatra">Odontopediatra</option>
                                            <!-- saúde bucal das crianças -->
                                            <option value="odontohebiatria">Odontohebiatria</option>
                                            <!-- saúde bucal dos adolescentes -->
                                            <option value="ortodontista">Ortodontista</option>
                                            <!-- aparelhos ortodônticos -->
                                            <option value="odontologiaestetica">Odontologia Estética</option>
                                            <!-- clareamentos dentais, uso de resinas e peeling gengival -->
                                            <option value="endodontista">Endodontista</option>
                                            <!-- tratamento de canal  -->
                                            <option value="periodontista">Periodontista</option>
                                            <!-- cuidados relacionados a doenças de gengiva -->
                                            <option value="protesista">Protesista</option>
                                            <!-- reabilitação bucal: estética, fonética e mastigação -->
                                            <option value="implantodontista">Implantodontista</option>
                                            <!-- inserção de protéses fixas/implantes -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-offset-4">
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                </div>

                            </form>
                        </div>

                        <div class="tab-pane fade" id="documentos">
                            <form class="form-horizontal" method="POST">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="cpffunc">CPF:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="cpffunc" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="rgfunc">RG:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="rgfunc" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="outro">Outro:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="outro">
                                    </div>
                                </div>
                                <div class="col-sm-offset-3">
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="endereco">
                            <form class="form-horizontal" method="POST">

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="estado">Estado:</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="estado" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="cidade">Cidade:</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="cidade" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="cep">CEP:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="cep" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="bairro">Bairro:</label>
                                    <div class="col-sm-3">
                                        <input type="bairro" class="form-control" name="bairro" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="logradouro">Tipo de logradouro:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="logradouro" required>
                                    </div>

                                    <label class="control-label col-sm-2" for="logradourofunc">Logradouro:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="logradourofunc" required>
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <label class="control-label col-sm-4" for="numero">Número:</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="numero" min="0" max="9999" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="complemento">Complemento:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="complemento" required>
                                    </div>
                                </div>
                                <div class="col-sm-offset-4">
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "footer.php" ?>