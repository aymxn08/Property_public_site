<?php

namespace App\Controllers;

use App\Models\EnquiryModel;

class Contact extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Contact Us'
        ];
        return view('pages/contact', $data);
    }

    public function submit()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('contact');
        }

        $enquiryModel = new EnquiryModel();
        
        $data = [
            'name'    => $this->request->getPost('name'),
            'phone'   => $this->request->getPost('phone'),
            'email'   => $this->request->getPost('email'),
            'message' => $this->request->getPost('message'),
        ];

        if ($enquiryModel->insert($data)) {
            return redirect()->back()->with('success', 'Thank you for contacting us. We will get back to you soon!');
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}
