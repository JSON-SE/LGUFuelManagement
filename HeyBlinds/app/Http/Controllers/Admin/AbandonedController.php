<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\SampleCart;
use Illuminate\Http\Request;
use App\Exports\ActionExport;
use App\Exports\SaveCartExport;
use App\Models\Front\Cart\Cart;
use App\Exports\AbandonedExport;
use App\Models\AbandonedCustomer;
use App\Models\Admin\Order\Order;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\Order\SampleOrder;
use Illuminate\Support\Facades\Storage;
// use Yajra\Datatables\Datatables;
use App\Http\Resources\SavecartResource;
use App\Http\Resources\AbandonedResource;

class AbandonedController extends Controller
{
    /**
     * Display the abonoed cart page
     *
     * @return admin.abandoned.index
     */
    public function index()
    {
        // $this->mergeOrderDataOnAbandonedTable();
        return view('admin.abandoned.index');
    }
    /**
     * Display the data of Abandon user
     *
     * @param Request $request
     *
     * @return Json
     */
    public function show(Request $request)
    {

        $users = AbandonedCustomer::query()->with('cart')->whereHas('cart')->select('abandoned_customers.*')->orderByDesc('updated_at');
        if ($request->date_range) {
            $date = explode('/', $request->date_range);
            $fromDate  = date("Y-m-d", strtotime($date[0] ?? ''));
            $toDate = date("Y-m-d", strtotime($date[1] ?? ''));
            $users = $users->whereBetween('updated_at', [$fromDate . ' 00:00:00', $toDate . ' 23:59:59']);
        }
        if($request->saved_email){
            $users->where('shipping_email','!=','');
        }
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $url = $row->cart->external_id ?? '';
                return  $btn = '<a class="btn btn-secondary btn-sm" href="' . route("frontend.checkout", $url) . '" target="_blank">View</a>';
            })
            ->addColumn('name', function ($row) {
                return $row->full_name ?? '';
            })
            ->addColumn('is_order_sample', function ($row) {
                return $row->cart_type == 1 ? "No": "Yes";
            })
            ->addColumn('cart_amount', function ($row) {
                return number_format($row->cart->cart_amount, 2);
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d'); // human readable format
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%Y-%m-%d') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            ->rawColumns(['action', 'name', 'cart_amount'])
            ->make(true);
    }
    private function checkOrder($data)
    {
        if ($data) {
            if ($data->cart) {
                return "No";
            }
            return "Yes";
        }
    }


    public function savedCart(Request $request)
    {
        return view('admin.abandoned.saved-cart');
    }

    public function manually()
    {
        return view('admin.manually');
    }
    /**
     * Export Abandoned data
     * @param Request $request
     * @return Excel file
     */

    public function exportAbadone(Request $request)
    {
        $fromDate = '';
        $toDate = '';
        if ($request->date_range) {
            $date = explode('/', $request->date_range);
            $fromDate  = date("Y-m-d", strtotime($date[0] ?? ''));
            $toDate = date("Y-m-d", strtotime($date[1] ?? ''));
        }
        return Excel::download(new ActionExport($fromDate, $toDate), 'actions-report.xlsx');
    }

    // public function exportSaveCart(Request $request)
    // {
    //     $date = explode(' / ' ,$request->date_range);
    //     $fromDate  = date("Y-m-d", strtotime($date[0] ?? ''));
    //     $toDate = date("Y-m-d",strtotime($date[1] ?? ''));
    //     return Excel::download(new SaveCartExport($fromDate,$toDate), 'save-cart.xlsx');
    // }

    /**
     * Merge Data On Abandoned Table
     */
    public function mergeOrderDataOnAbandonedTable()
    {
        //->where('search_date', '<', Carbon::now()->subDay(10));
        $carts = AbandonedCustomer::where('id', 0)->get();
        foreach ($carts as $cart) {
            $cart->delete();
            // if(empty($cart->cart->cart_id)){
            //     $cart->delete();
            // }
        }
    }
}
