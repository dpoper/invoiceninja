<?php
/**
 * Invoice Ninja (https://invoiceninja.com)
 *
 * @link https://github.com/invoiceninja/invoiceninja source repository
 *
 * @copyright Copyright (c) 2020. Invoice Ninja LLC (https://invoiceninja.com)
 *
 * @license https://opensource.org/licenses/AAL
 */

namespace App\Designs;

class Photo extends AbstractDesign
{

	public function __construct() {
	}


    public function includes()
    {
        return '
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>$number</title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta http-equiv="x-ua-compatible" content="ie=edge">
                    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
                    <style>
                    body {font-size:90%}
                    @page {
                        size: auto;
                        margin-top: 5mm;
                    }
                    #imageContainer {
                        background-image: url();
                        background-size: cover;
                    }

                    .table_header_thead_class { text-align: left; border-bottom-width: 4px; border-color: black; }
                    .table_header_td_class { font-weight: 400; text-transform: uppercase; padding: 1rem .5rem; }
                    .table_body_td_class { padding: 1rem; }
                    </style>
                </head>
        ';
    }



	public function header() {

		return '
                <div class="px-16 py-10">
                    <div class="flex items-center justify-between mt-2s">
                        <div ref="logo">
                            $company_logo
                        </div>
                        <div class="flex">
                            <div class="flex flex-col mr-5">
                                $entity_labels
                            </div>
                            <div class="flex flex-col text-right">
                                $entity_details
                            </div>
                        </div>
                    </div>
            </div>
			';

	}

	public function body() {

        return '
            <div class="flex content-center flex-wrap bg-gray-200 h-auto p-16" id="imageContainer">
                <div class="flex flex-col">
                    <div class="flex">
                        <p class="uppercase text-orange-800">$to_label:</p>
                        <div class="flex flex-col ml-2">
                            $client_details
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <p class="uppercase text-orange-800">$from_label:</p>
                        <div class="flex flex-col ml-2">
                            $company_details
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-16 py-16">';

	}

    public function task() {
    }

    public function task_table()
    {
        return '
            <table class="w-full table-auto">
                <thead class="text-left border-b-4 border-black">
                    <tr>
                        $task_table_header
                    </tr>
                </thead>
                <tbody>
                    $task_table_body
                </tbody>
            </table>';
    }

    public function product()
    {
        return '';
    }

    public function product_table() {
        return '
            <table class="w-full table-auto">
                <thead class="text-left border-b-4 border-black">
                    <tr>
                        $product_table_header
                    </tr>
                </thead>
                <tbody>
                    $product_table_body
                </tbody>
            </table>
            ';
	}

	public function footer() {

        return '
                            <div class="flex items-center justify-between mt-2 px-4 pb-4">
                        <div class="w-1/2">
                            <div class="flex flex-col">
                                <p>$entity.public_notes</p>
                            </div>
                        </div>
                        <div class="w-1/3 flex flex-col">
                            <div class="flex px-3 mt-2">
                                <section class="w-1/2 text-right flex flex-col">
                                    $total_tax_labels
                                    $line_tax_labels
                                </section>
                                <section class="w-1/2 text-right flex flex-col">
                                    $total_tax_values
                                    $line_tax_values
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4 pb-4 px-4">
                        <div class="w-1/2">
                            <div class="flex flex-col">
                                <p class="font-semibold">$terms_label</p>
                                <p>$terms</p>
                            </div>
                        </div>
                        <div class="flex w-2/5 flex-col">
                            <section class="flex bg-orange-700 py-2 text-white px-2 mt-1">
                                <p class="w-1/2">$balance_due_label</p>
                                <p class="text-right w-1/2">$balance_due</p>
                            </section>
                        </div>
                    </div>
                </div>

                </div>
            </body>
        </html>';

	}

}