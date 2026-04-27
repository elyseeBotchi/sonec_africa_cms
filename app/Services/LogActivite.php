<?php

namespace App\Services;

use App\Models\Activite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogActivite
{
    /**
     * Enregistre une action de création
     */
    public static function create($model, $data = null)
    {
        return self::log('CREATE', $model, $data);
    }

    /**
     * Enregistre une action de lecture
     */
    public static function read($model, $data = null)
    {
        return self::log('READ', $model, $data);
    }

    /**
     * Enregistre une action de mise à jour
     */
    public static function update($model, $data = null)
    {
        return self::log('UPDATE', $model, $data);
    }

    /**
     * Enregistre une action de suppression
     */
    public static function delete($model, $data = null)
    {
        return self::log('DELETE', $model, $data);
    }

    /**
     * Enregistre une action personnalisée
     */
    public static function custom($action, $model, $data = null)
    {
        return self::log($action, $model, $data);
    }

    /**
     * Méthode centrale pour enregistrer les activités
     */
    private static function log($action, $title = null, $description = null, $data = null)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return false;
            }

            // $modelName = class_basename($model);
            // $modelId = $model->id ?? null;

            Activite::create([
                'user_id' => $user->id,
                'action' => $action,
                'title' => $title ?? null,
                // 'model' => $modelName,
                // 'model_id' => $modelId,
                'description' => $description ?? null,
                // self::generateDescription($action, $modelName),
                'data' => $data ? json_encode($data) : null,
                'ip_address' => Request::ip(),
                'user_agent' => Request::header('User-Agent'),
                'url' => Request::fullUrl(),
            ]);

            return true;
        } catch (\Exception $e) {
            \Log::error('Erreur LogActivite: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Génère une description automatique selon l'action
     */
    private static function generateDescription($action, $modelName)
    {
        $descriptions = [
            'CREATE' => "Création d'un nouvel enregistrement $modelName",
            'READ' => "Lecture d'un enregistrement $modelName",
            'UPDATE' => "Modification d'un enregistrement $modelName",
            'DELETE' => "Suppression d'un enregistrement $modelName",
        ];

        return $descriptions[$action] ?? "Action $action sur $modelName";
    }

    /**
     * Récupère l'historique des activités
     */
    public static function getHistory($limit = 50)
    {
        return Activite::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupère l'historique par utilisateur
     */
    public static function getHistoryByUser($userId, $limit = 50)
    {
        return Activite::where('user_id', $userId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupère l'historique par modèle
     */
    public static function getHistoryByModel($model, $limit = 50)
    {
        $modelName = class_basename($model);
        
        return Activite::where('model', $modelName)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupère l'historique par enregistrement spécifique
     */
    public static function getHistoryByModelId($model, $modelId, $limit = 50)
    {
        $modelName = class_basename($model);
        
        return Activite::where('model', $modelName)
            ->where('model_id', $modelId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
