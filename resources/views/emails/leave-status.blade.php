<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Pengajuan Izin</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>Status Pengajuan Izin</h2>

    <p>Halo, <strong>{{ $leave->user->name }}</strong>.</p>

    <p>
        Pengajuan izin Anda pada tanggal:
    </p>

    <p>
        <strong>{{ $leave->date }}</strong>
    </p>

    <p>Status terbaru pengajuan:</p>

    @if($leave->status == 'approved')

        <p style="color: green; font-weight: bold;">
            DISETUJUI
        </p>

    @elseif($leave->status == 'rejected')

        <p style="color: red; font-weight: bold;">
            DITOLAK
        </p>

    @else

        <p style="font-weight: bold;">
            {{ strtoupper($leave->status) }}
        </p>

    @endif

    <p>
        <strong>Alasan izin:</strong>
    </p>

    <p>
        {{ $leave->reason }}
    </p>

    <br>

    <p>
        Terima kasih.
    </p>

    <p>
        <strong>PT. Anoa Sejahtera Mandiri</strong>
    </p>

</body>
</html>