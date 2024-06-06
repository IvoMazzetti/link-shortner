<?php

namespace App\Livewire;

use App\Models\LinkRedirect;
use App\Traits\LinkShortner;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class LinkRedirectController extends Component
{
    use LinkShortner;

    public Collection $links;
    public  $modelData;
    public array $collumns;
    public array $actions;
    public bool $showModal = false;
    public int|null $id = null;

    public string|null $originalLink = null;
    public string|null $redirectString = null;

    /**
     * Returns an array of validation attributes for the 'originalLink' and 'redirectString' fields.
     *
     * @return array An associative array with keys 'originalLink' and 'redirectString',
     *               and values as the corresponding validation attribute descriptions.
     */
    protected function getValidationAttributes(): array
    {
        return [
            'originalLink' => 'Original link',
            'redirectString' => 'Short value',
        ];
    }

    /**
     * Renders the view for the Livewire component 'link-redirect-controller'.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.link-redirect-controller');
    }

    /**
     * Initializes the component by fetching all LinkRedirect records and assigning them to the $links property.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->links = LinkRedirect::query()->get();
        $this->initDatatable();

    }

    /**
     * Initializes the datatable by fetching all column names from the 'link_redirects' table
     * and assigns them to the $collumns property. The column names are formatted with the first
     * letter of each word capitalized and any underscores replaced with spaces. The $actions property
     * is also initialized with an array containing the strings 'create', 'edit', and 'delete'.
     *
     * @return void
     */
    public function initDatatable(): void
    {
        $this->collumns = Schema::getColumnListing('link_redirects');
        $this->collumns = array_map(function ($column) {
            return ucwords(str_replace('_', ' ', $column));
        }, $this->collumns);

        $this->actions = [
            'create',
            'edit',
            'delete',
        ];
    }

     /**
     *  Display the modal for creation.
     *
     * @return void
     */
    public function create(): void
    {
        $this->showModal = true;
        $this->resetInputFields();
    }

     /**
     * Edit a LinkRedirect record by ID and set the originalLink and redirectString properties.
     *
     * @param int $id The ID of the LinkRedirect record to edit.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the LinkRedirect record with the given ID is not found.
     * @return void
     */
    public function edit($id): void
    {
        $this->create();

        $this->id = $id;
        $this->modelData = LinkRedirect::findOrFail($this->id, ['redirect_from', 'redirect_to'])->getAttributes();
        $this->originalLink = $this->modelData['redirect_from'];
        $this->redirectString = $this->modelData['redirect_to'];
    }

     /**
     * Deletes a LinkRedirect record by ID and displays a success message.
     *
     * @param LinkRedirect $link The LinkRedirect record to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(LinkRedirect $link)
    {
        $link->delete();
        $this->alert('success', 'Your link was successfully deleted.');
        return redirect()->route('dashboard');
    }

     /**
     * Returns an array of validation rules for the 'originalLink' and 'redirectString' fields.
     *
     * @return array An associative array with keys 'originalLink' and 'redirectString',
     *               and values as the corresponding validation rules.
     */
    public function rules()
    {
        return [
            'originalLink' => 'required|url',
            'redirectString' => ['string','max:10', Rule::unique('link_redirects', 'redirect_to')->ignore($this->id)],
        ];
    }

     /**
     * Creates a new short link and saves it to the database.
     *
     * This function validates the input data, creates a new instance of the LinkRedirect model,
     * sets the redirect_from and redirect_to properties with the values from the $originalLink and $redirectString
     * properties respectively, saves the model to the database, refreshes the links collection,
     * sets the showModal property to false, and displays a success message using the alert method.
     *
     * @throws \Illuminate\Validation\ValidationException if the validation fails
     * @return void
     */
    public function save(): void
    {
        $this->validate();
        $this->createShortLink($this->id ?? null, $this->originalLink, $this->redirectString);
        $this->resetInputFields();
        $this->showModal = false;
        $this->alert('success', 'Your link was successfully created.');
    }

    /**
     * Resets the input fields of the form.
     *
     * This function sets the values of the private properties $id, $originalLink, $redirectString, and $links to null.
     * It also queries the LinkRedirect model and assigns the result to the $links property.
     *
     * @return void
     */
    private function resetInputFields()
    {
        $this->id = null;
        $this->originalLink = null;
        $this->redirectString = null;
        $this->links = LinkRedirect::query()->get();
    }
}
