@extends('layouts.frontend')

@section('title', 'Pembelian Tiket - Rumah Ticket')


@section('content')

    @include('partials.guard-auth')


    <div class="min-h-screen bg-primary-50 flex items-center justify-center px-6 py-10">


        <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl overflow-hidden">


            <!-- Header -->
            <div class="bg-linear-to-r from-primary-600 to-primary-700 p-8 text-white">

                <h1 class="text-3xl font-extrabold">
                    Pembelian Tiket
                </h1>


                <p class="mt-2 text-primary-100">
                    Upload bukti pembayaran untuk menyelesaikan pembelian
                </p>

            </div>

            <div class="p-8">
                <!-- Detail Ticket -->
                <div class="bg-primary-50 rounded-2xl p-5 mb-6">


                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        Detail Tiket
                    </h2>

                    <div id="ticketDetail"></div>

                    <div class="border-t border-primary-200 pt-3 mt-3 flex justify-between">

                        <span class="font-bold">
                            Total Bayar
                        </span>


                        <span class="font-bold text-primary-600" id="ticketTotal">
                            Rp0
                        </span>


                    </div>


                </div>

                <!-- Alert -->
                <div id="alertError"
                    class="hidden mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">
                </div>

                <!-- Upload -->

                <form id="paymentForm">


                    <label class="block font-semibold text-gray-700 mb-3">

                        Upload Bukti Pembayaran

                    </label>



                    <input type="file" id="paymentProof" name="payment_proof" accept="image/*" required
                        class="w-full border border-primary-200 rounded-xl p-3 mb-6 focus:outline-none focus:ring-2 focus:ring-primary-500">



                    <button type="submit" id="submitBtn"
                        class="w-full bg-secondary-600 hover:bg-secondary-700 text-white font-bold py-4 rounded-xl transition disabled:opacity-60 disabled:cursor-not-allowed">


                        Kirim Pembayaran


                    </button>


                </form>



            </div>


        </div>


    </div>


    <script>
        window.API_URL = "{{ config('global.api_url', 'http://localhost:8001/api') }}";
    </script>

    @vite(['resources/js/payment.js'])

@endsection
