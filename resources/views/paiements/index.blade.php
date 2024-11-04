@extends('layouts.template')

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Paiements</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
					                    </div>
					                    <div class="col-auto">

					                        <button type="submit" class="btn app-btn-secondary">Search</button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
							    <div class="col-auto">
								    
								    <select class="form-select w-auto" >
										  <option selected value="option-1">All</option>
										  <option value="option-2">This week</option>
										  <option value="option-3">This month</option>
										  <option value="option-4">Last 3 months</option>
										  
									</select>
							    </div>
							    <div class="col-auto">	
									@if ($isPaymentDay)
																		    
									<a class="btn app-btn-secondary" href="{{route('payment.init')}}">
									    lancer les paiements
									</a>
									@endif					    

							    </div>
						    </div><!--//row-->
						    
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
				    	@if (Session::get('success_message'))
						<div class="alert alert-success">{{Session::get('success_message')}}</div>
					@endif
					@if (Session::get('status_message'))
						<div class="alert alert-success">{{Session::get('status_message')}}</div>
					@endif
					@if (Session::get('error_message'))
						<div class="alert alert-danger">{{Session::get('error_message')}}</div>
					@endif
					@if (!$isPaymentDay)
						<div class="alert alert-danger">Vous ne pourrez pas effectuée de paiement qu'à la date de paiement</div>
					@endif
			    </div><!--//row-->

				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">References</th>
												<th class="cell">Employes</th>
												<th class="cell">Montant payé</th>
												<th class="cell">Date de Transaction</th>
												<th class="cell">Mois</th>
												<th class="cell">Année</th>
												<th class="cell">Statut</th>
                                                            <th></th>
											</tr>
										</thead>
										<tbody>
                                                       @forelse ($payments as $payment)
                                                       <tr>
												<td class="cell">{{$payment->reference}}</td>
												<td class="cell">{{ $payment->employer->nom }} {{ $payment->employer->prenom }}</td>
												<td class="cell">{{ $payment->amount }} mad</td>
												<td class="cell">{{ date('d-m-y',strtotime($payment->launch_date)) }}</td>
												<td class="cell">{{ $payment->month }}</td>
												<td class="cell">{{ $payment->year }}</td>
												<td class="cell"><button class="btn btn-success">{{ $payment->status }}</button></td>
												<td class="cell">
													<a href="{{ route('payment.download',$payment->id) }}">
														<i class="fa fa-download"></i>
													</a>
												</td>

												{{-- 
													<td class="cell">
													<a class="btn-sm app-btn-secondary" href="{{route('administrateurs.delete',$admin->id)}}">Retirer</a>
												</td> --}}
                                                       </tr>	
                                                       @empty
                                                       <tr>
												<td class="cell" colspan="8"><div style="text-align: center ;padding:2rem">Aucune transaction effectuée</div></td>
                                                       </tr>	
                                                       @endforelse
	
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->

						<nav class="app-pagination">
							{{$payments->links()}}
						</nav>
			        </div><!--//tab-pane-->
				</div><!--//tab-content-->
@endsection