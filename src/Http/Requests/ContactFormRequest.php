<?php
namespace BrikaCMS\Modules\Contacts\Http\Requests;

use BrikaCMS\Http\Requests\AbstractFormRequest;

class ContactFormRequest extends AbstractFormRequest {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company' => 'required',
            'msg' => 'required'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Merci d\'insérer votre Nom',
            'email.required' => 'Merci d\'insérer votre email',
            'email.email' => 'Merci vérifier votre email',
            'phone.required' => 'Merci d\'insérer votre téléphone',
            'company.required' => 'Merci d\'insérer votre société',
            'msg.required' => 'Merci d\'insérer votre Message'
        ];
    }
}
