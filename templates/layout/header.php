<?php
/* START: Global Header Template */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Professional medical manuscript submission and peer-review system. Clinical-grade editorial workflow engine.">
    <meta name="user-role" content="<?php echo $_SESSION['role'] ?? 'Guest'; ?>">
    <title>JournalDB | Editorial Manager Clone</title>
    
    <!-- START: Typography (Outfit) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- END: Typography -->

    <!-- Global Design System (Processed by Tailwind CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        :root {
            --primary-indigo: #4f46e5;
            --primary-indigo-hover: #4338ca;
            --slate-900: #0f172a;
            --slate-700: #334155;
            --slate-500: #64748b;
            --slate-400: #94a3b8;
            --slate-100: #f1f5f9;
            --bg-clinical: #f8fafc;
        }

        @layer base {
            body { @apply bg-slate-50 text-slate-900 antialiased font-['Outfit',sans-serif]; }
            h1 { @apply text-4xl font-bold tracking-tight text-slate-900 mb-6; }
            h2 { @apply text-2xl font-bold text-slate-800 mb-4; }
            h3 { @apply text-xl font-bold text-slate-800 mb-3; }
            p  { @apply text-[18px] font-normal text-slate-600 leading-relaxed mb-4; }
        }

        .ui-glassmorphism {
            @apply bg-white/70 backdrop-blur-lg border border-white/20 shadow-xl shadow-indigo-500/10;
        }

        @layer components {
            .ui-container { @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8; }
            .ui-grid-canvas { @apply grid grid-cols-12 gap-8 lg:gap-12; }
            .ui-card { @apply bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden transition-all duration-300; }
            .ui-card-header { @apply p-6 border-b border-slate-100 flex justify-between items-center bg-white; }
            .ui-card-body { @apply p-6 bg-white; }
            .ui-heading-hero { @apply text-4xl md:text-5xl font-bold tracking-tight text-slate-900 leading-tight mb-4; }
            .ui-badge-indigo { @apply inline-flex items-center px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-indigo-50 text-indigo-700 border border-indigo-100; }
            .ui-btn-primary { @apply inline-flex items-center justify-center px-6 py-3 rounded-lg font-semibold bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm active:scale-95; }
            .ui-btn-secondary-compact { @apply inline-flex items-center justify-center px-4 py-2 rounded-lg font-semibold bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-xs; }
        }
    </style>
</head>
<body class="site-body">
    <!-- START: Navigation Section -->
    <header class="site-header bg-white border-b border-slate-100 py-4">
        <div class="ui-container">
            <div class="flex justify-between items-center">
                <div class="header-logo-container">
                    <span class="text-2xl font-black tracking-tighter text-indigo-600">
                        EDM<span class="text-slate-400">CLONE</span>
                    </span>
                </div>
                
                <nav class="flex items-center gap-8">
                    <a href="/JournalDB/public/dashboard" class="text-sm font-semibold text-slate-500 hover:text-indigo-600">Dashboard</a>
                    <a href="/JournalDB/public/submissions" class="text-sm font-semibold text-slate-500 hover:text-indigo-600">My Submissions</a>
                    <div class="flex items-center gap-4 pl-8 border-l border-slate-100">
                        <span class="text-sm font-bold text-indigo-600"><?php echo $_SESSION['user_name'] ?? 'User'; ?></span>
                        <a href="/JournalDB/public/logout" class="ui-btn-secondary-compact">Sign Out</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- END: Navigation Section -->

    <!-- START: Main Content Grid -->
    <main class="container mx-auto px-4 py-12">
