@extends('log-viewer::_template.master')

@section('content')
<h1 class="page-header">
    Logs
</h1>
{!! $rows->render() !!}
<div class="table-responsive">
    <table class="table table-condensed table-hover table-stats">
        <thead>
            <tr>
                @foreach($headers as $key => $header)
                <th class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                    @if ($key == 'date')
                    <span class="label label-info">
                        {{ $header }}
                    </span>
                    @else
                    <span class="level level-{{ $key }}">
                        {!! log_styler()->icon($key) . ' ' . $header !!}
                    </span>
                    @endif
                </th>
                @endforeach
                <th class="text-right">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @if ($rows->count() > 0)
                    @foreach($rows as $date => $row)
            <tr>
                @foreach($row as $key => $value)
                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                    @if ($key == 'date')
                    <span class="label label-primary">
                        {{ $value }}
                    </span>
                    @elseif ($value == 0)
                    <span class="level level-empty">
                        {{ $value }}
                    </span>
                    @else
                    <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                        <span class="level level-{{ $key }}">
                            {{ $value }}
                        </span>
                    </a>
                    @endif
                </td>
                @endforeach
                <td class="text-right">
                    <a class="btn btn-xs btn-info" href="{{ route('log-viewer::logs.show', [$date]) }}">
                        <i class="fa fa-search">
                        </i>
                    </a>
                    <a class="btn btn-xs btn-success" href="{{ route('log-viewer::logs.download', [$date]) }}">
                        <i class="fa fa-download">
                        </i>
                    </a>
                    <a class="btn btn-xs btn-danger" data-log-date="{{ $date }}" href="#delete-log-modal">
                        <i class="fa fa-trash-o">
                        </i>
                    </a>
                </td>
            </tr>
            @endforeach
                @else
            <tr>
                <td class="text-center" colspan="11">
                    <span class="label label-default">
                        {{ trans('log-viewer::general.empty-logs') }}
                    </span>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{!! $rows->render() !!}
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
<div class="modal fade" id="delete-log-modal">
    <div class="modal-dialog">
        <form action="{{ route('log-viewer::logs.delete') }}" id="delete-log-form" method="POST">
            <input name="_method" type="hidden" value="DELETE">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="date" type="hidden" value="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                    <span aria-hidden="true">
                                        ×
                                    </span>
                                </button>
                                <h4 class="modal-title">
                                    DELETE LOG FILE
                                </h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal" type="button">
                                    Cancel
                                </button>
                                <button class="btn btn-sm btn-danger" data-loading-text="Loading…" type="submit">
                                    DELETE FILE
                                </button>
                            </div>
                        </div>
                    </input>
                </input>
            </input>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            $("a[href=#delete-log-modal]").on('click', function(event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(
                    'Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">' + date + '</span> ?'
                );

                deleteLogModal.modal('show');
            });

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(data);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            deleteLogModal.on('hidden.bs.modal', function() {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
</script>
@endsection
