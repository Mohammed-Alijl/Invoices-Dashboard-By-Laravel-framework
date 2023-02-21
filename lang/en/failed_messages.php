<?php


return[
    //===================================================================================
    // PUBLIC============================================================================
    //===================================================================================
    'failed'=>'There was a problem, please try again',
    'authorize'=>'You are not authorized',

    //===================================================================================
    // ATTACHMENTS=======================================================================
    //===================================================================================
    'attachment.add'=>'The attachment could not be added, please try again',
    'attachment.delete'=>'The attachment could not be deleted, please try again',
    'attachment.invoice_id.required'=>'Invoice id is required',
    'attachment.invoice_id.integer'=>'Invoice Number should be only numbers',
    'attachment.invoice_id.exists'=>'The invoice is not exists',
    'attachment.invoice_number.required'=>'Invoice number is required',
    'attachment.invoice_number.numeric'=>'Invoice Number should be only numbers',
    'attachment.invoice_number.exists'=>'Invoice Number is wrong',
    'attachment.pic.mimes'=>'Attachments must be in pdf, jpg, png, or jpeg format',
    'attachment.pic.max'=>'Attachment size is too large',

    //===================================================================================
    // CUSTOMERS REPORTS=================================================================
    //===================================================================================
    'reports.section_id.required'=>'Please choose a bank from the options',
    'reports.section_id.exists'=>'Please choose a bank from the options',
    'reports.section_id.numeric'=>'Please choose a bank from the options',
    'reports.section_id.min'=>'Please choose a bank from the options',
    'reports.product_id.required'=>'Please choose the transaction from the options',
    'reports.product_id.exists'=>'Please choose the transaction from the options',
    'reports.product_id.numeric'=>'Please choose the transaction from the options',
    'reports.product_id.min'=>'Please choose the transaction from the options',
    'reports.start_at.date_format'=>'Please stick to the d/m/y format',
    'reports.start_at.before'=>'The end date cannot be earlier than the start date',
    'reports.end_at.date_format'=>'Please stick to the d/m/y format',

    //===================================================================================
    // INVOICES==========================================================================
    //===================================================================================
    'invoices.add'=>'An error occurred while adding, please try again',
    'invoices.edit.notFound'=>'The invoice to be edit does not exist',
    'invoices.edit'=>'An error occurred while adding the modifications, please try again',
    'invoices.destroy.notFound'=>'The invoice to be deleted does not exist',
    'invoices.destroy'=>'An error occurred while trying to delete the invoice, please try again',
    'invoices.archive.notFound'=>'The invoice to be archived does not exist',
    'invoices.archive'=>'An error occurred while trying to archive the invoice',
    'invoices.recovery'=>'An error occurred while trying to archive the invoice',
    'invoices.print.notFound'=>'The invoice to be printed does not exist',
    'invoices.invoice_number.required'=>'Please enter the invoice number',
    'invoices.invoice_number.unique'=>'This invoice number is already in use, please choose another number',
    'invoices.invoice_number.min'=>'Invoice number must be a positive number',
    'invoices.invoice_number.max'=>'The invoice number is greater than allowed',
    'invoices.invoice_number.numeric'=>'The invoice number must be numbers only',
    'invoices.invoice_date.required'=>'Please enter an invoice date',
    'invoices.invoice_date.date'=>'Please enter a valid date',
    'invoices.invoice_date.date_format'=>'The date format must be Y-m-d',
    'invoices.due_date.required'=>'Please enter a due date',
    'invoices.due_date.date'=>'Please enter a valid date',
    'invoices.due_date.date_format'=>'The date format must be Y-m-d',
    'invoices.due_date.after_or_equal'=>'The due date must be greater than or equal to the invoice date',
    'invoices.section_id.required'=>'Please select a bank from the options',
    'invoices.section_id.exists'=>'Please select a bank from the options',
    'invoices.section_id.numeric'=>'Please select a bank from the options',
    'invoices.section_id.min'=>'Please select a bank from the options',
    'invoices.product_id.required'=>'Please select a transaction from the options',
    'invoices.product_id.exists'=>'Please select a transaction from the options',
    'invoices.product_id.numeric'=>'Please select a transaction from the options',
    'invoices.product_id.min'=>'Please select a transaction from the options',
    'invoices.discount.required'=>'Please enter the discount, and if there is no discount, enter zero',
    'invoices.discount.numeric'=>'Please enter numbers only',
    'invoices.discount.lte'=>'The discount amount must be less than the commission amount',
    'invoices.discount.min'=>'The commission amount cannot be negative',
    'invoices.amount_commission.required'=>'Please enter a commission amount',
    'invoices.amount_commission.numeric'=>'The commission amount must be numbers only',
    'invoices.amount_commission.lte'=>'The commission amount must be less than the collection amount',
    'invoices.amount_commission.min'=>'The commission amount is less than allowed',
    'invoices.amount_collection.required'=>'Amount required',
    'invoices.amount_collection.numeric'=>'The collection amount must be numbers only',
    'invoices.amount_collection.max'=>'The amount of collection is greater than the allowable amount',
    'invoices.amount_collection.min'=>'The amount of collection is less than allowed',
    'invoices.note.string'=>'notes must be text',
    'invoices.note.max'=>'the notes are too big',
    'invoices.rate_vat.required'=>'VAT rate must be 5% or 10%',
    'invoices.rate_vat.in'=>'VAT rate must be 5% or 10%',
    'invoices.pic.mimes'=>'The attachment format must be pdf, jpeg, .jpg, png',
    'invoices.pic.max'=> 'Attachment is too big',

    //===================================================================================
    // INVOICES REPORTS==================================================================
    //===================================================================================
    'reports.radio.required'=>'Please select a search method',
    'reports.radio.in'=>'Please select a search method',
    'reports.status.required_if'=>'Please select a invoice type',
    'reports.status.in'=>'Please select a invoice type',
    'reports.invoice_number.required_if'=>'Please enter the invoice number',

    //===================================================================================
    // PAYMENTS==========================================================================
    //===================================================================================
    'payments.change.notFound'=>'The invoice whose payment status needs to be modified does not exist',
    'payments.collection_amount.required'=>'Amount required',
    'payments.collection_amount.numeric'=>'The amount paid must be numbers only',
    'payments.collection_amount.min'=>'Please enter at least 1',
    'payments.note.max'=>'The note is too large',
    'payments.collection.less.rest'=>'The amount paid must not be greater than the amount due',

    //===================================================================================
    // PRODUCTS==========================================================================
    //===================================================================================
    'product.name.required'=>'Transaction name required',
    'product.notFound'=>'This transaction does not exist',
    'product.name.max'=>'The transaction name must be less than 30 characters long',
    'product.name.unique'=>'This transaction already exists',
    'product.description.required'=>'Description is required',
    'product.description.min'=>'Transaction description must be at least 10 characters long',
    'product.description.max'=>'Transaction description is too large',
    'product.section_id.exists'=>'This bank does not exist',
    'product.section_name.exists'=>'This bank does not exist',

    //===================================================================================
    // SECTIONS==========================================================================
    //===================================================================================
    'section.section_name.required'=>'Bank name is required',
    'section.notFound'=> 'This bank does not exist',
    'section.section_name.unique'=>'This bank already exists',
    'section.section_name.min'=>'Bank name is too short',
    'section.section_name.max'=>'The bank name must be less than 30 characters long',
    'section.description.required'=>'The description field is required',
    'section.description.max'=>'The description is too long',
    'section.name.required'=>'Bank name required',
    'section.name.unique'=>'This bank already exists',
    'section.name.min'=>'Bank name is too short',
    'section.name.max'=>'The bank name must be less than 30 characters long',

    //===================================================================================
    // USERS=============================================================================
    //===================================================================================
    'user.notFound'=>'Sorry, this user does not exist',
    'user.destroy.notFound'=>'The user you are trying to delete does not exist',
    'user.name.unique'=>'The username is already in use, please choose another username',
    'user.name.max'=>'The username is too long',
    'user.email.email'=>'Please enter a valid email',
    'user.email.unique'=>'This email is already in use',
    'user.password.same'=>'The password and confirmation do not match, please try again',
    'user.roles_name.array'=>'An error occurred, please try again',
    'user.roles_name.exists'=>'An error occurred, please try again',
    'user.pic.mimes'=>'you must choose a picture from us extension: jpeg, jpg, png, svg',
    'user.pic.max'=>'The image is too big, please choose a smaller profile picture',
];
