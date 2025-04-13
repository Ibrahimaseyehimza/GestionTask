<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskCompletedNotification;
use App\Notifications\TaskCreatedNotification;
use auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
     // Afficher toutes les tâches
     public function index()
     {
         return Task::all();
     }

     // Créer une tâche
     public function store(Request $request)
     {
        //  $request->validate([
        //      'title' => 'required|string|max:255',
        //      'description' => 'nullable|string',
        //      'due_date' => 'nullable|date',
        //  ]);

        //  $task = Task::create([
        //      'title' => $request->title,
        //      'description' => $request->description,
        //      'due_date' => $request->due_date,
        //      'is_completed' => false,
        //  ]);

        //     $task = new Task($validated);
        //     $task->user_id = auth()->id(); // Associe l'utilisateur connecté
        //     $task->save();

        //  $task = Task::create($request->all());
        //  return response()->json($task, 201);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // Ajouter le statut "non complété" par défaut
        $validated['is_completed'] = false;

        // Ajouter l'ID de l'utilisateur connecté si nécessaire
        // if (auth()->check()) {
        //     // $validated['user_id'] = auth()->id();
        //     return response()->json(['error' => 'Utilisateur non authentifié.'], 401);
        // }

        if (!auth()->check()) {
            return response()->json(['error' => 'Utilisateur non authentifié.'], 401);
        }


          // Ajouter l'ID de l'utilisateur et le statut par défaut
            $validated['user_id'] = auth()->id();
            $validated['is_completed'] = false;

        $task = Task::create($validated);


        // 🔔 Envoie l'e-mail à l'utilisateur
        $user = auth()->user();
        $user->notify(new TaskCreatedNotification($task));

        return response()->json($task, 201);
     }

     // Afficher une tâche spécifique
     public function show($id)
     {
         return Task::findOrFail($id);
     }

     // Mettre à jour une tâche
     public function update(Request $request, $id)
     {
         $task = Task::findOrFail($id);

           // 🛠️ Capture l'état avant la mise à jour
            $wasCompleted = $task->is_completed;

         $task->update([
             'title' => $request->title,
             'description' => $request->description,
             'due_date' => $request->due_date,
             'is_completed' => $request->has('is_completed') ? $request->is_completed : $task->is_completed,
         ]);

         $task = Task::findOrFail($id);
        $task->update($request->all());

          // 🔔 Envoie l'e-mail si la tâche vient d'être marquée comme complétée
            if (!$wasCompleted && $task->is_completed) {
                $user = auth()->user();
                $user->notify(new TaskCompletedNotification($task));
            }

         return response()->json($task);
     }

     // Supprimer une tâche
     public function destroy($id)
     {
         $task = Task::findOrFail($id);
         $task->delete();

         return response()->json(null, 204);
     }
}
