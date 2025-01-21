<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\{
    CablePlan,
    DataBundle, Decoder, Education, Electricity, Network
};
use Illuminate\Http\Request;

class BillsController extends Controller
{
    //
    public function api_setting(){
        return view('admin.bills.setting');
    }

    public function airtime(){
        $networks = Network::whereStatus(1)->get();
        return view('admin.bills.airtime', compact('networks'));
    }

    // Airtime Status
    public function airtime_status($id, $status){
        $network = Network::findorFail($id);
        $network->airtime = $status;
        $network->save();
        return redirect()->back()->withSuccess(__('Network Updated Successfully.'));
    }
    public function update_airtime (Request $request, $id){
        $request->validate([
            'minimum' => 'required|string|min:2'
        ]);
        $network = Network::findorFail($id);
        $network->minimum = $request->minimum;
        $network->save();
        return redirect()->back()->withSuccess(__('Network updated Successfully.'));
    } 
    // Data 
    public function internet_data(){
        $networks = Network::whereStatus(1)->get();
        return view('admin.bills.data.index', compact('networks'));
    }
    public function datasub_status($id, $status){
        $network = Network::findorFail($id);
        $network->data = $status;
        $network->save();
        return redirect()->back()->withSuccess(__('Network Updated Successfully.'));
    }
    function manage_dataplans($id){
        $network = Network::whereStatus(1)->whereId($id)->first();
        $dataplans = DataBundle::whereNetworkId($id)->whereDeleted(0)->get();
        return view('admin.bills.data.plans', compact('network','dataplans'));
    }

    function create_dataplan(Request $request){
        $request->validate([
            'network_id' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'code' => 'required|string'
        ]);
        $dataplan = new DataBundle();
        $dataplan->name = $request->name;
        $dataplan->network_id = $request->network_id;
        $dataplan->service = $request->service;
        $dataplan->price = $request->price;
        $dataplan->status = 1;
        $dataplan->code = $request->code;
        $dataplan->save();

        return redirect()->back()->withSuccess(__('Dataplan Created Successfully.'));
    }
    function edit_dataplan(Request $request, $id){
        $request->validate([
            'network_id' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'code' => 'required|string'
        ]);
        $dataplan = DataBundle::findorFail($id);
        $dataplan->name = $request->name;
        $dataplan->price = $request->price;
        $dataplan->service = $request->service;
        $dataplan->code = $request->code;
        $dataplan->save();

        return redirect()->back()->withSuccess(__('Dataplan Created Successfully.'));
    }
    public function dataplan_status($id, $status){
        $data = DataBundle::findorFail($id);
        $data->status = $status;
        $data->save();
        return redirect()->back()->withSuccess(__('Dataplan Updated Successfully.'));
    }

    // cable tv
    function cabletv(){
        $decoders = Decoder::all();
        return view('admin.bills.cabletv.index', compact('decoders'));
    }
    public function cabletv_status($id, $status){
        $decoder = Decoder::findorFail($id);
        $decoder->status = $status;
        $decoder->save();
        return redirect()->back()->withSuccess(__('Decoder Updated Successfully.'));
    }
    function manage_cabletvplans($id){
        $decoder = Decoder::whereStatus(1)->whereId($id)->first();
        $plans = CablePlan::whereDecoderId($id)->whereDeleted(0)->get();
        return view('admin.bills.cabletv.plans', compact('decoder','plans'));
    }
    function create_cabletvplan(Request $request){
        $request->validate([
            'decoder_id' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'code' => 'required|string'
        ]);
        $plan = new CablePlan();
        $plan->name = $request->name;
        $plan->decoder_id = $request->decoder_id;
        $plan->price = $request->price;
        $plan->status = 1;
        $plan->code = $request->code;
        $plan->save();

        return redirect()->back()->withSuccess(__('TV plan Created Successfully.'));
    }
    function edit_cabletvplan(Request $request, $id){
        $request->validate([
            'decoder_id' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'code' => 'required|string'
        ]);
        $plan = CablePlan::findorFail($id);
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->code = $request->code;
        $plan->save();

        return redirect()->back()->withSuccess(__('Cable plan Created Successfully.'));
    }
    public function cableplan_status($id, $status){
        $plan = CablePlan::findorFail($id);
        $plan->status = $status;
        $plan->save();
        return redirect()->back()->withSuccess(__('Plan Updated Successfully.'));
    }

    // electricity
    public function electricity(){
        $powers = Electricity::whereDeleted(0)->get();
        return view('admin.bills.electricity', compact('powers'));
    }
    public function electricity_status($id, $status){
        $plan = Electricity::findorFail($id);
        $plan->status = $status;
        $plan->save();
        return redirect()->back()->withSuccess(__('Plan Updated Successfully.'));
    }
    function create_electricity(Request $request){
        $request->validate([
            'fee' => 'required',
            'name' => 'required|string',
            'minimum' => 'required|numeric',
            'code' => 'required|string'
        ]);
        $plan = new Electricity();
        $plan->name = $request->name;
        $plan->fee = $request->fee;
        $plan->minimum = $request->minimum;
        $plan->code = $request->code;
        $plan->save();

        return redirect()->back()->withSuccess(__('Electricity Created Successfully.'));
    }
    function edit_electricity(Request $request, $id){
        $request->validate([
            'fee' => 'required',
            'name' => 'required|string',
            'minimum' => 'required|numeric',
            'code' => 'required|string'
        ]);
        $plan = Electricity::findOrFail($id);
        $plan->name = $request->name;
        $plan->fee = $request->fee;
        $plan->minimum = $request->minimum;
        $plan->code = $request->code;
        $plan->save();

        return redirect()->back()->withSuccess(__('Electricity Updated Successfully.'));
    }

    // Bulk sms
    public function bulksms(){
        return view('admin.bills.bulksms');
    }
    // Airtme swap
    public function airtime_swap(){
        $networks = Network::whereStatus(1)->get();
        return view('admin.bills.a2cash', compact('networks'));
    }
    // Airtime swap Status
    public function airtimeswap_status($id, $status){
        $network = Network::findorFail($id);
        $network->swap = $status;
        $network->save();
        return redirect()->back()->withSuccess(__('Network Updated Successfully.'));
    }
    public function update_airtimeswap (Request $request, $id){
        $request->validate([
            'number' => 'required|string|min:2',
            'rate' => 'required'
        ]);
        $network = Network::findorFail($id);
        $network->rate = $request->rate;
        $network->number = $request->number;
        $network->save();
        return redirect()->back()->withSuccess(__('Network updated Successfully.'));
    } 
    // Recharge Pins
    public function recharge_pins(){
        $networks = Network::whereStatus(1)->get();
        return view('admin.bills.cards', compact('networks'));
    }
    public function rechargepin_status($id, $status){
        $network = Network::findorFail($id);
        $network->cardpin = $status;
        $network->save();
        return redirect()->back()->withSuccess(__('Network Updated Successfully.'));
    }
    public function update_rechargepin (Request $request, $id){
        $request->validate([
            'p_code' => 'required'
        ]);
        $network = Network::findorFail($id);
        $network->p_code = $request->p_code;
        $network->save();
        return redirect()->back()->withSuccess(__('Network updated Successfully.'));
    } 

    // Education
    public function education(){
        $services = Education::whereDeleted(0)->get();
        return view('admin.bills.education', compact('services'));
    }
    
    public function education_status($id, $status){
        $plan = Education::findorFail($id);
        $plan->status = $status;
        $plan->save();
        return redirect()->back()->withSuccess(__('Plan Updated Successfully.'));
    }
    public function update_education (Request $request, $id){
        $request->validate([
            'code' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric'
        ]);
        $plan = Education::findorFail($id);
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->code = $request->code;
        $plan->save();
        return redirect()->back()->withSuccess(__('Plan updated Successfully.'));
    } 
}
