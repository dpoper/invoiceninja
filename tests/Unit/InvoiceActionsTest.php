<?php

namespace Tests\Unit;

use App\Factory\PaymentFactory;
use App\Utils\Traits\Invoice\ActionsInvoice;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\MockAccountData;
use Tests\TestCase;

/**
 * @test
 * @covers  App\Utils\Traits\Invoice\ActionInvoice
 */
class InvoiceActionsTest extends TestCase
{
    use MockAccountData;
    use DatabaseTransactions;
    use ActionsInvoice;

    public function setUp() :void
    {
        parent::setUp();
    
        $this->makeTestData();
    }

    public function testInvoiceIsDeletable()
    {
        $this->assertTrue($this->invoiceDeletable($this->invoice));
        $this->assertTrue($this->invoiceReversable($this->invoice));
        $this->assertFalse($this->invoiceCancellable($this->invoice));
    }

    public function testInvoiceIsReversable()
    {
        $this->invoice->service()->markPaid()->save();

        $this->assertFalse($this->invoiceDeletable($this->invoice));
        $this->assertTrue($this->invoiceReversable($this->invoice));
        $this->assertFalse($this->invoiceCancellable($this->invoice));
    }

    public function testInvoiceIsCancellable()
    {
        $payment = PaymentFactory::create($this->invoice->company_id, $this->invoice->user_id);
        $payment->amount = 40;
        $payment->client_id = $this->invoice->client_id;
        $payment->applied = 0;
        $payment->refunded = 0;
        $payment->date = now();
        $payment->save();

        $this->invoice->service()->applyPayment($payment, 5)->save();

        $this->assertFalse($this->invoiceDeletable($this->invoice));
        $this->assertTrue($this->invoiceReversable($this->invoice));
        $this->assertTrue($this->invoiceCancellable($this->invoice));
    }

    public function testInvoiceUnactionable()
    {
        $this->invoice->delete();

        
        $this->assertFalse($this->invoiceDeletable($this->invoice));
        $this->assertFalse($this->invoiceReversable($this->invoice));
        $this->assertFalse($this->invoiceCancellable($this->invoice));
    }

}