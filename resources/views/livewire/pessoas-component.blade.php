<div>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h3><strong>Laravel LivewireCRUD</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;"><strong>Pessoas Cadastradas</strong></h5>
                        <button class="btn btn-sm btn-primary" style="float: right;" data-toggle="modal" data-target="#addPessoaModal">Novo Cadastro</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th style="text-align: center;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pessoas->count() > 0)
                                    @foreach ($pessoas as $p)
                                        <tr>
                                            <td>{{ $p->pessoa_id }}</td>
                                            <td>{{ $p->nome }}</td>
                                            <td>{{ $p->email }}</td>
                                            <td>{{ $p->telefone }}</td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-sm btn-secondary" wire:click="viewPessoaDetails({{ $p->id }})">Ver</button>
                                                <button class="btn btn-sm btn-primary" wire:click="editPessoa({{ $p->id }})">Editar</button>
                                                <button class="btn btn-sm btn-danger" wire:click="deleteConfirmation({{ $p->id }})">Deletar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align: center;"><small>No Student Found</small></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addPessoaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Pessoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="store">
                        <div class="form-group row">
                            <label for="pessoa_id" class="col-3">ID</label>
                            <div class="col-9">
                                <input type="number" id="pessoa_id" class="form-control" wire:model="pessoa_id">
                                @error('pessoa_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-3">Nome</label>
                            <div class="col-9">
                                <input type="text" id="nome" class="form-control" wire:model="nome">
                                @error('nome')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-3">Telefone</label>
                            <div class="col-9">
                                <input type="number" id="telefone" class="form-control" wire:model="telefone">
                                @error('telefone')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editPessoaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="editar">
                        <div class="form-group row">
                            <label for="pessoa_id" class="col-3">ID</label>
                            <div class="col-9">
                                <input type="number" id="pessoa_id" class="form-control" wire:model="pessoa_id">
                                @error('pessoa_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-3">Nome</label>
                            <div class="col-9">
                                <input type="text" id="nome" class="form-control" wire:model="nome">
                                @error('nome')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-3">Telefone</label>
                            <div class="col-9">
                                <input type="number" id="telefone" class="form-control" wire:model="telefone">
                                @error('telefone')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="deletePessoaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Você tem certeza que quer deletar?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button class="btn btn-sm btn-danger" wire:click="deletePessoaData()">Sim</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="viewPessoaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeViewPessoaModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID: </th>
                                <td>{{ $view_pessoa_id }}</td>
                            </tr>

                            <tr>
                                <th>Nome: </th>
                                <td>{{ $view_pessoa_nome }}</td>
                            </tr>

                            <tr>
                                <th>Email: </th>
                                <td>{{ $view_pessoa_email }}</td>
                            </tr>

                            <tr>
                                <th>Telefone: </th>
                                <td>{{ $view_pessoa_telefone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addPessoaModal').modal('hide');
            $('#editPessoaModal').modal('hide');
            $('#deletePessoaModal').modal('hide');
        });
        window.addEventListener('show-edit-pessoa-modal', event =>{
            $('#editPessoaModal').modal('show');
        });
        window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deletePessoaModal').modal('show');
        });
        window.addEventListener('show-view-pessoa-modal', event =>{
            $('#viewPessoaModal').modal('show');
        });
    </script>
@endpush