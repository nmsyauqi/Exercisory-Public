flowchart TD

%% =========================
%%         LEGEND
%% =========================
subgraph LEGEND["Legenda Aktor"]
    L1[Guest]
    L2[User (Login)]
    L3[Admin]
    L4[Participant]
    L5[System Scheduler]
end

%% =========================
%%   PUBLIC AREA (GUEST)
%% =========================
subgraph PUBLIC["PUBLIC AREA (Tanpa Login)"]
    
    A1[/User akses '/dashboard'/]
    A2{Authenticated?}

    %% Guest flow
    A2 -- "Tidak / Guest" --> A3[Halaman Dashboard (Read-Only)]

    %% Public routes
    P1[/Guest akses '/welcome'/]
    P2[Halaman Welcome]

    P3[/Guest akses '/leaderboard'/]
    P4[Halaman Leaderboard]

    P5[/User akses '/checklist'/]
    P6[Checklist tampil (Publik)]

    %% trap logic
    T1{Guest klik checkbox?}
    T1 -- "Ya" --> T2[/Redirect ke '/sign-in'/]
    T1 -- "Tidak" --> P6

end


%% =========================
%%   DASHBOARD LOGIC (MAIN)
%% =========================

A2 -- "Ya / Login" --> R1{Role?}

R1 -- "ADMIN" --> R2[/Redirect '/admin/tasks'/]
R1 -- "PARTICIPANT" --> R3[/Redirect '/checklist'/]


%% =========================
%%   MEMBER AREA (LOGIN)
%% =========================
subgraph MEMBER["MEMBER AREA"]
    direction TB

    %% Admin
    M1[/Akses '/admin/*'/]
    M2{Role Admin?}
    M2 -- "Ya" --> M3[Halaman Admin Panel]
    M2 -- "Tidak" --> M4[/Forbidden (403)/]

    %% Participant protected pages
    H1[/Akses '/history'/]
    H2{Role Participant?}
    H2 -- "Ya" --> H3[Halaman History]
    H2 -- "Tidak" --> H4[/Forbidden/]

    S1[/Akses '/profile'/]
    S2{Role Participant?}
    S2 -- "Ya" --> S3[Halaman Profile]
    S2 -- "Tidak" --> S4[/Forbidden/]

end


%% =========================
%%     SCHEDULER (AUTO)
%% =========================
subgraph SCHED["BACKEND AUTOMATION (Scheduler)"]
    direction TB

    SC1([Scheduler Harian])
    SC2[[Jalankan Command: SendChecklistReminders]]
    SC3[(Query DB: cari user belum check-in)]
    SC4[(Insert Notification ke DB)]
    SC5[Notifikasi tampil ke Participant (Livewire Polling)]
    
    SC1 --> SC2 --> SC3 --> SC4 --> SC5
end


%% ====== CONNECT PUBLIC → MEMBER (Login) ====
T2 --> A2
