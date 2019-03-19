@extends('organizer.game.base')

@section('game-content')
    <div class="container">
        @for($i=0; $i<$game->total_tickets; $i++)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$i}}">
                $0
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Tickets</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <!-- Button trigger modal -->

@endsection