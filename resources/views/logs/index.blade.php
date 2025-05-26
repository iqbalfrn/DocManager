@extends('layouts.app')

@section('content')
<h4>Log Aktivitas</h4>

<form method="GET" class="form-inline mb-3">
  <div class="form-group mr-2">
    <label for="from" class="mr-1">Dari</label>
    <input
      type="date"
      name="from"
      id="from"
      class="form-control"
      value="{{ request('from') }}"
    >
  </div>

  <div class="form-group mr-2">
    <label for="to" class="mr-1">Sampai</label>
    <input
      type="date"
      name="to"
      id="to"
      class="form-control"
      value="{{ request('to') }}"
    >
  </div>

  <button type="submit" class="btn btn-secondary mr-auto">Filter</button>

  <a
    href="#"
    class="btn btn-danger"
    onclick="event.preventDefault(); document.getElementById('clean-form').submit();"
  >
    Hapus Log > 30 hari
  </a>
  <form
    id="clean-form"
    action="{{ route('logs.clean') }}"
    method="POST"
    class="d-none"
  >
    @csrf
    @method('DELETE')
  </form>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th>User</th>
      <th>Aksi</th>
      <th>IP Address</th>
      <th>Waktu</th>
    </tr>
  </thead>
  <tbody>
    @forelse($logs as $log)
      <tr>
        <td>{{ $log->user->name }}</td>
        <td>{{ $log->action }}</td>
        <td>{{ $log->ip_address }}</td>
        <td>{{ $log->created_at }}</td>
      </tr>
    @empty
      <tr>
        <td colspan="4" class="text-center">Tidak ada log aktivitas.</td>
      </tr>
    @endforelse
  </tbody>
</table>

{{ $logs->links() }}
@endsection
