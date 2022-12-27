@extends('config.index')

@section('config_content')
    <pre>{{ print_r($env, 1) }}</pre>
    <div id="phpinfo">
        {!! $phpinfo !!}
    </div>
@endsection

@section('style')
    <style>
        #phpinfo table {
            width: 100%;
            margin: 0 auto;
        }

        #phpinfo h1 {
            font-size: x-large;
        }

        #phpinfo h2 {
            font-size: large;
            background-color: purple;
            color: white;
            padding: .5rem;
            text-transform: uppercase;
        }

        #phpinfo tr {
            border-bottom: 1px dotted #aaa;
        }

        #phpinfo th,
        #phpinfo td {
            padding: .5rem;
        }

        #phpinfo table td.e {
            font-weight: bold;
            background-color: #eee;
            width: 150px;
            overflow-x: auto;
            word-wrap: break-word;
        }

        #phpinfo table td.v {
            max-width: 300px;
            overflow-x: auto;
            word-wrap: break-word;
        }


        #phpinfo table tr.h {
            background-color: #eee;
            color: purple;
            text-align: left !important;
        }

        /* #phpinfo table th
            #phpinfo table td {
                padding: 0.5rem;
                border-bottom: 1px dotted #aaa;
                text-align: left;
            }
            #phpinfo table td.e {
                font-weight: bold;
                width:1%;
                white-space: nowrap;
            }
            #phpinfo table td.v {
                background-color: #ddd;
                --max-width: 300px;
                overflow-x: auto;
                word-wrap: break-word;
            } */
    </style>
@endsection
