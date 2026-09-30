<?php

final class ResourceService
{
    public function __construct(private PDO $db) {}

    public function show(array $request, ?array $user): array
    {
        // Código intencionalmente difícil de leer: refactoricen este método en clase.
        if ($user !== null) {
            if ($user['activo'] == 1) {
                if (isset($request['id'])) {
                    if (is_numeric($request['id'])) {
                        $resource = $this->find((int)$request['id']);
                        if ($resource) {
                            if ($resource['estado'] === 'publicado') {
                                if ($user['rol'] === 'admin') return ['status'=>200,'resource'=>$resource];
                                if ($resource['propietario_id'] == $user['id']) return ['status'=>200,'resource'=>$resource];
                                if ($user['rol'] === 'cliente' && $resource['visible'] == 1) return ['status'=>200,'resource'=>$resource];
                                return ['status'=>403,'message'=>'Sin permiso'];
                            }
                            return ['status'=>404,'message'=>'No encontrado'];
                        }
                        return ['status'=>404,'message'=>'No encontrado'];
                    }
                    return ['status'=>400,'message'=>'ID inválido'];
                }
                return ['status'=>400,'message'=>'Falta ID'];
            }
            return ['status'=>403,'message'=>'Cuenta inactiva'];
        }
        return ['status'=>401,'message'=>'Debe iniciar sesión'];
    }

    private function find(int $id): ?array
    {
        $query = $this->db->prepare('SELECT id,titulo,descripcion,propietario_id,tipo,estado,departamento,visible FROM recursos WHERE id = :id');
        $query->execute(['id'=>$id]);
        return $query->fetch() ?: null;
    }
}
