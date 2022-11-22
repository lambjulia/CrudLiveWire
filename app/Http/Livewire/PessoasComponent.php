<?php

namespace App\Http\Livewire;
use App\Pessoas;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class PessoasComponent extends Component
{
    public $pessoa_id, $nome, $email, $telefone, $pessoat_edit_id, $pessoa_delete_id;

    public $view_pessoa_id, $view_pessoa_nome, $view_pessoa_email, $view_pessoa_telefone;

    public function store(){

        $this->validate([
            'pessoa_id' => 'required|unique:pessoas',
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|numeric',
        ]);

        $pessoas = new Pessoas();
        $pessoas->pessoa_id = $this->pessoa_id;
        $pessoas->nome = $this->nome;
        $pessoas->email = $this->email;
        $pessoas->telefone = $this->telefone;
        $pessoas->save();

        session()->flash('message', 'Cadastro efetuado com sucesso!');

        $this->pessoa_id = '';
        $this->nome = '';
        $this->email = '';
        $this->telefone = '';

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function update($fields) {
        $this->validateOnly($fields, [
            'pessoa_id'=>'required|unique:pessoa',
            'nome'=>'required',
            'email'=>'required|email',
            'telefone'=>'required|numeric'
        ]);
    }

    public function resetInputs()
    {
        $this->pessoa_id = '';
        $this->nome = '';
        $this->email = '';
        $this->telefone = '';
        $this->pessoa_edit_id = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function editPessoa($id)
    {
        $pessoas = Pessoas::where('id', $id)->first();

        $this->pessoa_edit_id = $pessoas->id;
        $this->pessoa_id = $pessoas->pessoa_id;
        $this->nome = $pessoas->nome;
        $this->email = $pessoas->email;
        $this->telefone = $pessoas->telefone;

        $this->dispatchBrowserEvent('show-edit-pessoa-modal');
    }
    
    public function editar()
    {
        //on form submit validation
        $this->validate([
            'pessoa_id' => 'required|unique:pessoas,pessoa_id,'.$this->pessoa_edit_id.'', //Validation with ignoring own data
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|numeric',
        ]);

        $pessoas = Pessoas::where('id', $this->pessoa_edit_id)->first();
        $pessoas->pessoa_id = $this->pessoa_id;
        $pessoas->nome = $this->nome;
        $pessoas->email = $this->email;
        $pessoas->telefone = $this->telefone;

        $pessoas->save();

        session()->flash('message', 'Dados alterados com sucesso!');

        $this->dispatchBrowserEvent('close-modal');
    }

    //Delete Confirmation
    public function deleteConfirmation($id)
    {
        $this->pessoa_delete_id = $id; 

        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    public function deletePessoaData()
    {
        $pessoas = Pessoas::where('id', $this->pessoa_delete_id)->first();
        $pessoas->delete();

        session()->flash('message', 'Dados deletados com sucesso!');

        $this->dispatchBrowserEvent('close-modal');

        $this->pessoa_delete_id = '';
    }

    public function cancel()
    {
        $this->pessoa_delete_id = '';
    }

    public function viewPessoaDetails($id)
    {
        $pessoas = Pessoas::where('id', $id)->first();

        $this->view_pessoa_id = $pessoas->pessoa_id;
        $this->view_pessoa_nome = $pessoas->nome;
        $this->view_pessoa_email = $pessoas->email;
        $this->view_pessoa_telefone = $pessoas->telefone;

        $this->dispatchBrowserEvent('show-view-pessoa-modal');
    }

    public function closeViewPessoaModal()
    {
        $this->view_pessoa_id = '';
        $this->view_pessoa_nome = '';
        $this->view_pessoa_email = '';
        $this->view_pessoa_telefonee = '';
    }


    public function render()
    {
        $pessoas = Pessoas::all();
        return view('livewire.pessoas-component', ['pessoas'=>$pessoas])->layout('livewire.layouts.app');
    }
}
